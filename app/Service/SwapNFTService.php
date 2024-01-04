<?php

namespace App\Service;

use App\Models\ArbitrageSession;
use App\Models\Nfts;
use App\Models\NftSwapSession;
use App\Models\SwapNftSession;
use App\Traits\ReplyMarkups;
use App\Traits\SendMessages;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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


            // // PROMPTING USER THAT API SEARCHIN IS GOING ON
            // $msg = "🔎 Searching... ";
            // $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
            // sleep(rand(3,10));
            // $this->telegrambot->deletMessages($msg_response,$user_id);

            // $msg = "🔊 Scanning price volatility difference for $user_response ";
            // $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
            // sleep(rand(3,12));
            // $this->telegrambot->deletMessages($msg_response,$user_id);


            // $exchanges = $this->getRandomExchanges();

            // foreach ($exchanges as $key => $value) {
            //     $msg = "🤖 Signaling {$value}";
            //     $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
            //     sleep(rand(1,4));
            //     $this->telegrambot->deletMessages($msg_response,$user_id);

            // }

            // //END  PROMPTING USER THAT API SEARCHIN IS GOING ON




            // $pairs = "$pair_one/$pair_two";
            // $responseMessage = $this->getArbitrageOpportunities($pairs, $user->id);

            // if($this->arbitrage_found)
            // {
            //     $msg = "🎯 Arbitrage Opportunity found...";
            //     $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
            //     sleep(rand(1,4));
            //     $this->telegrambot->deletMessages($msg_response,$user_id);

            //     $msg_response = $this->telegrambot->sendMessageToUser($user_id, $responseMessage);



            //     // http_response_code(200);
            //     // echo "ok";
            //     // sleep(rand(60,110));
            //     // $this->telegrambot->deletMessages($msg_response,$user_id);

            //     $user_session->endSession();

            // }else {
            //     $msg_response = $this->telegrambot->sendMessageToUser($user_id, $responseMessage);
            // }

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
                    $this->telegrambot->sendMessageToUser($user_id, "No NFTs available for arbitrage at the moment.");
                    return;
                }

                foreach ($nftList as $nft) {
                    $this->telegrambot->sendMessageToUser($user_id, $nft['text'], null, $nft['image']);
                }

                $user_session_data['step'] = 'select nft';
                $user_session->update_session($user_session_data);
            } catch (\Exception $e) {
                info($e);
                $this->telegrambot->sendMessageToUser($user_id, "An error occurred while fetching NFTs.");
            }

            $arbitrageSession->decrement('number_of_response_left');
        }
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
                'text' => "{$nft->name} - {$nft->meta_data}",
                'image' => $nft->image
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

    private function findNFTArbitrageOpportunity($user_id)
    {
        // Logic to find an NFT arbitrage opportunity
        // This is a placeholder - you need to implement the actual logic
        return "Placeholder: NFT Arbitrage Opportunity Details.";
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
