<?php

namespace App\Service;

use App\Models\ArbitrageSession;
use App\Models\Nfts;
use App\Models\NftSwapOrder;
use App\Models\NftSwapSession;
use App\Models\Session;
use App\Models\SwapNftSession;
use App\Traits\ReplyMarkups;
use App\Traits\SendMessages;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;


class SwapNFTService implements ServiceInterface
{
    use SendMessages;
    use ReplyMarkups;
    protected $apiKey;
    protected $apiUrl;
    private $exchanges;
    public $telegrambot;
    public $arbitrage_found = false;
    public $exchange_one;
    public $exchange_two;


    public function __construct()
    {
        $this->exchanges = Config::get("nft_exchanges");
        $this->telegrambot = new TelegramBotService();
    }

    public function continueBotSession($user_id, $user_session, $user_response = "")
    {
        // Fetch the current session data for the user
        $user_session_data = $user_session->getUserSessionData();
        $step = $user_session_data['step'] ?? null;

        $user = UserService::fetchUserByTgID($user_id);
        $responses = rand(6, 10);
        // $responses = 10;
        $arbitrage_session = $this->initializeDailySession($user->id, $responses);

        // Check if the user's daily limit is reached or reset timer if needed
        if (time() >= $arbitrage_session->restart_timer) {
            $arbitrage_session->restart_timer = time() + 86400; // Reset the timer for the next day
            $responses = rand(6, 10);
            // $responses = 10;
            $arbitrage_session->number_of_response_left = $responses; // Reset the response count
            $arbitrage_session->total_responses = $responses; // Reset the response count
            $arbitrage_session->save();
        }

        if ($arbitrage_session->number_of_response_left <= 0) {
            // $this->telegrambot->sendMessageToUser($user_id, "You have reached your daily limit for using Exchange2Exchange API Binding.");
            $user_session->endSession();
            return;
        }


        if ($step == "check toc selection") {
            $toc_selection = $user_response;
            if ($toc_selection == "cancel_nftSwapToc") {
                $this->telegrambot->sendMessageToUser($user_id, "NFT Swap Canceled");
                return true;
            } else {
                $msg = <<<MSG
                NFTs are unique digital assets that represent ownership of specific items, such as virtual
                concert tickets or rare pieces of art 🎨. NFTs are stored on the blockchain, which means 
                they can't be easily edited, copied or duplicated. 🔐 There, they can act as a publicly verifiable
                proof of ownership on a decentralized database.
                
                ⚠️ Disclaimer: API has been built to detect volatilities across floor price of total volume of collectibles
                and not the individual NFTs themselves 📊.
                MSG;
                $inline = $this->nftTracker();
                $this->telegrambot->sendMessageToUser($user_id, $msg, $inline);
                $user_session_data['step'] = 'run nft tracker';
                $user_session->update_session($user_session_data);
                return true;
            }
        }

        if ($step == "run nft tracker" && $user_response == "nft_tracker") {
            $arbitrageSession = NftSwapSession::where('user_id', $user->id)->first();
            $this->updateArbitrageableNft($user->id);


            if (!$arbitrageSession || $arbitrageSession->number_of_response_left <= 0) {
                // $this->telegrambot->sendMessageToUser($user_id, "You have reached your daily limit for NFT tracking.");
                return;
            }


            try {
                $nftList = $this->fetchArbitrableNFTs($user->id);
                if (empty($nftList)) {
                    $this->telegrambot->sendMessageToUser($user_id, "An error occurred while fetching NFTs.");
                    return;
                }

                // foreach ($nftList as $nft) {
                //     $this->telegrambot->sendMessageToUser($user_id, $nft['text'], null, $nft['image']);
                // }

                foreach ($nftList as $nft) {
                    $caption = "Name: " . $nft['name']; // Use the NFT name in the caption
                    $inlineKeyboard = $this->createNftInlineKeyboard($nft['id']);

                    $this->telegrambot->sendMessageToUser($user_id, $caption, $inlineKeyboard, $nft['image']);
                }

                $user_session_data['step'] = 'select nft';
                $user_session->update_session($user_session_data);
            } catch (\Exception $e) {
                info($e);
                $this->telegrambot->sendMessageToUser($user_id, "An error occurred while fetching NFTs.");
            }

            $arbitrageSession->decrement('number_of_response_left');
        }


        if ($step == "select nft" && strpos($user_response, "nft_selected_") !== false) {
            // Extract NFT ID from the response
            $selectedNftId = str_replace("nft_selected_", "", $user_response);

            // Store the selected NFT ID in the session
            $user_session_data['selected_nft_id'] = $selectedNftId;
            $user_session->update_session($user_session_data);

            // Run loading messages
            // $this->displayLoadingMessages($user_id, $nft);

            // Decide to show error or profit and display it
            $this->handleNftOutcome($user->id, $selectedNftId, $user_id);
        }

        if ($step === 'awaiting_wallet_address') {
            $orderId = $user_session_data['swap_nft_order_id'];
            $this->updateWalletAddressForOrder($user_id, $orderId, $user_response);
            return true;
        }

    }

    private function displayNftProfitInfo($user_id, $nft)
    {
        // Fetch NFT details from the database
        if ($nft) {
            $profitPercent = rand(10, 250) / 1000; // Random profit percentage between 0.1% to 2.5%
            $profitMessage = "🏆 ARBITRAGE OPPORTUNITY FOR {$nft->name}\n"
                . "Buy for: {$nft->price}\n"
                . "🥇Potential profit: {$profitPercent}%\n";

            // Send the profit info as a photo message
            // $this->telegrambot->sendPhotoMessage($user_id, $nft->image, $profitMessage);
            $this->telegrambot->sendMessageToUser($user_id, $profitMessage, null,  $nft['image']);

            $cryptomus_service = new CryptomusService();
            $order_id = Str::uuid();
            $callbackurl = route("swap-nft.payment.callback");

            $payment_details = $cryptomus_service->createPayment("300", "usdt", $order_id, $callbackurl);
            $text = "<code>{$payment_details["address"]}</code>";
            $this->telegrambot->sendMessage($user_id, $text);


            // Create a new swap order
            $swapOrder = NftSwapOrder::create([
                'user_id' => $user_id,
                'order_id' => $order_id,
                'nft_id' => $nft->id,
                'status' => 'pending', // Initial status
                // 'wallet_address' is null by default
            ]);
        }
    }


    private function handleNftOutcome($user_id, $nftId, $tg_user_id)
    {
        $nftSwapSession = NftSwapSession::where('user_id', $user_id)->first();
        $nft = Nfts::find($nftId);

        if (!$nft) {
            // Handle case where NFT is not found
            return;
        }

        // Display loading messages
        $this->displayLoadingMessages($tg_user_id, $nft);

        // Check if any outcome's chance is exhausted and then decide
        if ($nftSwapSession->nft_profit_display_chance == 0) {
            // Only show error as profit chance is exhausted
            $this->telegrambot->sendMessageToUser($tg_user_id, "Error fetching data for NFT: {$nft->name}");
            $nftSwapSession->decrement('nft_error_display_chance');
        } elseif ($nftSwapSession->nft_error_display_chance == 0) {
            // Only show profit as error chance is exhausted
            $this->success_message($tg_user_id);
            $this->displayNftProfitInfo($tg_user_id, $nft);
            $nftSwapSession->decrement('nft_profit_display_chance');
        } else {
            // Both outcomes are still possible, randomly choose
            if (rand(0, 1) < 0.7) {
                // Show profit info
                $this->success_message($tg_user_id);
                $this->displayNftProfitInfo($tg_user_id, $nft);
                $nftSwapSession->decrement('nft_profit_display_chance');
            } else {
                // Show error message
                $this->telegrambot->sendMessageToUser($tg_user_id, "Error fetching data for NFT: {$nft->name}");
                $nftSwapSession->decrement('nft_error_display_chance');
            }
        }
    }

    private function success_message($user_id)
    {
        $text =   "🎯 A Price Graduation of at least 0.0005USDT+ across marketplaces detected...";
        $msg_response = $this->telegrambot->sendMessageToUser($user_id, $text);
        sleep(rand(2, 5)); // Short delay for realism
        $this->telegrambot->deletMessages($msg_response, $user_id);
    }


    private function displayLoadingMessages($user_id, $nft)
    {

        $exchanges = $this->getRandomExchanges();
        $loadingMessages = [
            "🔎 Searching...",
            "🔊 Scanning price volatility difference for {$nft->name}...",
        ];

        foreach ($loadingMessages as $msg) {
            $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
            sleep(rand(2, 5)); // Short delay for realism
            $this->telegrambot->deletMessages($msg_response, $user_id);
        }

        foreach ($exchanges as $key => $exchange) {
            $text =   "🤖 Signaling various $exchange";
            $msg_response = $this->telegrambot->sendMessageToUser($user_id, $text);
            sleep(rand(2, 5)); // Short delay for realism
            $this->telegrambot->deletMessages($msg_response, $user_id);
        }

        return true;
    }





    private function fetchArbitrableNFTs($user_id)
    {
        $swapSession = NftSwapSession::where('user_id', $user_id)->first();

        if (!$swapSession) {
            return null;
        }

        $nfts = Nfts::inRandomOrder()->take($swapSession->arbitrageable_nft)->get();
        return $nfts->map(function ($nft) {
            return [
                'name' => $nft->name,
                'image' => $nft->image,
                'id' => $nft->id
            ];
        })->toArray();
    }




    public function initializeDailySession($user_id, $totalResponses)
    {
        $now = time();
        $nftSwapSession = NftSwapSession::firstOrNew(['user_id' => $user_id]);

        if (!$nftSwapSession->exists || $now >= $nftSwapSession->restart_timer) {
            $responsiveChance = round(0.6 * $totalResponses);
            $unresponsiveChance = $totalResponses - $responsiveChance;


            // Update 'arbitrageable_nft' every time the NFT tracker is accessed
            $nftSwapSession->fill([
                'restart_timer' => $now + 86400,
                'number_of_response_left' => $totalResponses,
                'arbitrageable_nft' => rand(1, 4),
                'total_responses' => $totalResponses,
                'responsive_chance' => $responsiveChance,
                'unresponsive_chance' => $unresponsiveChance
            ])->save();
        }

        return $nftSwapSession;
    }


    private function updateArbitrageableNft($user_id)
    {
        $nftSwapSession = NftSwapSession::where('user_id', $user_id)->first();

        if ($nftSwapSession) {
            $nftSwapSession->arbitrageable_nft = rand(1, 4);
            $nftClicks = rand(6, 10); // Random number of NFT clicks
            $nftSwapSession->nft_clicks_left = $nftClicks;
            $nftSwapSession->nft_profit_display_chance = round(0.7 * $nftClicks);
            $nftSwapSession->nft_error_display_chance = $nftClicks - $nftSwapSession->nft_profit_display_chance;
            $nftSwapSession->save();
        }
    }







    private function displayNFTsToUser($user_id, $nftSwapSession)
    {
        $nftList = $this->fetchArbitrableNFTs($user_id);
        if (empty($nftList)) {
            $this->telegrambot->sendMessageToUser($user_id, "No NFTs available at the moment.");
            return;
        }

        foreach ($nftList as $nft) {
            $this->telegrambot->sendMessageToUser($user_id, $nft['text'], null, $nft['image']);
        }

        $nftSwapSession->decrement('number_of_response_left');
        // Update session step for NFT selection
    }

    




    public function startSessionForWalletAddress($user, $orderId)
    {
        // Create or update the session for the user
        sleep(rand(60,120));
        // $session = Session::firstOrCreate(['user_id' => $user->tg_id]);
        $session = new SessionService($user->tg_id);
        $session->fetch_user_session();
        $session->set_session_route("SwapNFTService", "awaiting_wallet_address");
        $session->add_value_to_session("swap_nft_order_id",$orderId);

        // Send a message to the user asking for their wallet address
        $this->telegrambot->sendMessageToUser($user->tg_id, "Please enter your wallet address:");
        return true;
    }


    private function updateWalletAddressForOrder($user_id, $orderId, $walletAddress)
    {
        $order = NftSwapOrder::where('id', $orderId)->first();
        if ($order) {
            $order->update(['wallet_address' => $walletAddress]);
            // Notify user of the update
            $this->telegrambot->sendMessageToUser($user_id, "Your wallet address has been recorded.");
        }
    }







    public function getRandomExchanges()
    {
        // Ensure the array has more than 15 elements to pick from

        // Determine the number of elements to pick (between 7 and 15)
        $numElementsToPick = rand(7, 15);

        // Get random keys
        $randomKeys = array_rand($this->exchanges, $numElementsToPick);

        // Extract the values corresponding to the random keys
        $randomSubset = array_intersect_key($this->exchanges, array_flip($randomKeys));

        // Pick two unique random keys from the subset
        $selectedKeys = array_rand($randomSubset, 2);

        // Assign the values to properties
        $this->exchange_one = $randomSubset[$selectedKeys[0]];
        $this->exchange_two = $randomSubset[$selectedKeys[1]];

        return $randomSubset; // or you can return just the two selected exchanges
    }
}
