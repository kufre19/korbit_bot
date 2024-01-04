<?php

namespace App\Service;

use App\Models\ArbitrageSession;
use App\Models\Nfts;
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
        // $responses = rand(10, 15);
        $responses = 10;
        $arbitrage_session = $this->initializeDailySession($user->id,$responses);

        // Check if the user's daily limit is reached or reset timer if needed
        if (time() >= $arbitrage_session->restart_timer) {
            $arbitrage_session->restart_timer = time() + 86400; // Reset the timer for the next day
            // $responses = rand(10, 15);
            $responses = 10;
            $arbitrage_session->number_of_response_left = $responses; // Reset the response count
            $arbitrage_session->total_responses = $responses; // Reset the response count
            $arbitrage_session->save();
        }

        if ($arbitrage_session->number_of_response_left <= 0) {
            $this->telegrambot->sendMessageToUser($user_id, "You have reached your daily limit for using Exchange2Exchange API Binding.");
            $user_session->endSession();
            return;
        }

        
        if ($step == "check toc selection") {
            $toc_selection = $user_response;
            if ($toc_selection == "cancel_nftSwapToc") {
                $this->telegrambot->sendMessageToUser($user_id, "NFT Swap Canceled");
                return true;
            }else{
                $msg = <<<MSG
                NFTs are unique digital assets that represent ownership of specific items, such as virtual
                concert tickets or rare pieces of art 🎨. NFTs are stored on the blockchain, which means 
                they can't be easily edited, copied or duplicated. 🔐 There, they can act as a publicly verifiable
                proof of ownership on a decentralized database.
                
                ⚠️ Disclaimer: API has been built to detect volatilities across floor price of total volume of collectibles
                and not the individual NFTs themselves 📊.
                MSG;
                $inline = $this->nftTracker();
                $this->telegrambot->sendMessageToUser($user_id,$msg,$inline);
                $user_session_data['step'] = 'run nft tracker';
                $user_session->update_session($user_session_data);
                return true;


            }

            // $pair_one = strtoupper($pairs[0]);
            // $pair_two = strtoupper($pairs[1]);

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

        if ($step == "run nft tracker") {
            if ($user_response == "nft_tracker") {
                // Randomly decide if the button should be responsive
                if (rand(1, 10) <= 4) { // 40% chance of being unresponsive
                    // Unresponsive behavior
                    return;
                }
    
                // Fetch list of NFTs
                $nftList = $this->fetchArbitrableNFTs();
                if (!$nftList) {
                    $this->telegrambot->sendMessageToUser($user_id, "No NFTs available for arbitrage at the moment.");
                    return;
                }
    
                // Display NFTs to the user
                $message = $this->formatNFTListMessage($nftList);
                $this->telegrambot->sendMessageToUser($user_id, $message);
    
                // Update session step to handle NFT selection
                $user_session_data['step'] = 'select nft';
                $user_session->update_session($user_session_data);
            }
        }
    



    }

    private function fetchArbitrableNFTs($user_id)
    {
        // Fetch the current session for the user
        $swapSession = SwapNftSession::where('user_id', $user_id)->first();

        if (!$swapSession) {
            // Handle the case where there is no session
            return null;
        }

        // Get the number of NFTs to fetch
        $numberOfNFTs = $swapSession->arbitrageable_nft;

        // Fetch the specified number of random NFTs from the NFTs table
        $nfts = Nfts::inRandomOrder()->take($numberOfNFTs)->get();

        if ($nfts->isEmpty()) {
            // Handle the case where no NFTs are available
            return null;
        }

        // Convert the NFTs to an array for easier handling
        $nftList = $nfts->toArray();

        return $nftList;
    }


    
    public function initializeDailySession($user_id, $totalResponses) {
        $errorJsonChance = round(0.2 * $totalResponses); 
        $errorDataChance = round(0.2 * $totalResponses); 
        $notFoundChance = round(0.1 * $totalResponses); 
        $successChance = $totalResponses - ($errorJsonChance + $errorDataChance + $notFoundChance);
    
        return SwapNftSession::firstOrCreate( 
        ['user_id' => $user_id],
        ['restart_timer' => time() + 86400,
         'number_of_response_left' => $totalResponses,
         'arbitrageable_nft'=>rand(1,4),
         "total_responses" => $totalResponses,
         'error_json_chance' => $errorJsonChance,
         'error_data_chance' => $errorDataChance,
         'not_found_chance' => $notFoundChance,
         'success_chance' => $successChance
        ],
        
        );
    }
    
    public function getArbitrageOpportunities($pair, $user_id) {
        $session = ArbitrageSession::where('user_id', $user_id)->first();
    
        if (!$session || $session->number_of_response_left <= 0) {
            return "Daily limit reached. Try again tomorrow.";
        }
    
        $probabilities = [
            'error_json' => $session->error_json_chance,
            'error_data' => $session->error_data_chance,
            'not_found' => $session->not_found_chance,
            'success' => $session->success_chance,
        ];
    
        // Filter out the probabilities that are zero
        $availableProbabilities = array_filter($probabilities, function ($chance) {
            return $chance > 0;
        });
    
        if (empty($availableProbabilities)) {
            return "Daily limit reached. Try again tomorrow....";
        }
    
        // Randomly pick a response type
        $responseType = array_rand($availableProbabilities);
    
        // Deduct from the selected probability and update session
        $session->{$responseType . '_chance'}--;
        $session->number_of_response_left--;
        $session->save();
    
        // Generate the response based on the selected type
        switch ($responseType) {
            case 'error_json':
                return "Error parsing JSON response.";
            case 'error_data':
                return "Error fetching data for {$pair}: Trying to access array offset on value of type null.";
            case 'not_found':
                return "🛑Arbitrage opportunity for {$pair} not found. Try the 'Swap Crypto' API feature.";
            case 'success':
                return $this->simulateArbitrageOpportunity($pair);
        }
    }
    
    private function simulateArbitrageOpportunity($pairs)
    {
        // Extract the base and quote currencies from the pair
        $pair_split = explode('/', $pairs);


        if (!in_array("USD", $pair_split)) {
            // Handle cases where the quote currency is not USD
            return "Currently, only pairs with USD as the quote currency are supported.";
        }

        if ($pair_split[0] == "USD") {
            $cryptoCurrency = $pair_split[1];
            $fiat = $pair_split[0];
        } else {
            $cryptoCurrency = $pair_split[0];
            $fiat = $pair_split[1];
        }

        // Fetch the current price for the base currency in terms of USD
        $response = $this->fetchCryptoPriceInUSD($cryptoCurrency,$fiat);

        if ($response != null) {
            $currentPrice =  $response;
        } else {
            // throw new \Exception("Failed to fetch price data.");
            return "Failed to fetch price data.";
        }

        // Calculate the sell price with a simulated profit margin
        $profitPercent = rand(1, 19) / 10; // 0.1% to 1.9%
        $sellPrice = $currentPrice * (1 + $profitPercent / 100);

        $currentPrice = number_format($currentPrice, 2);
        $sellPrice = number_format($sellPrice, 2);


        $this->arbitrage_found = true;
        return "🏆 ARBITRAGE OPPORTUNITY FOR {$pairs}\n"
            . "Buy on: {$this->exchange_one} at \${$currentPrice}\n"
            . "Sell on: {$this->exchange_two} at \${$sellPrice}\n"
            . "🥇Potential profit: {$profitPercent}%\n"
            . "⚠️ WARNING: Be aware that cryptocurrencies are subject to rapid price fluctuations.";
    }



  


 
    public function getRandomExchanges() {
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
