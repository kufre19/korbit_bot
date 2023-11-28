<?php

namespace App\Service;

use App\Models\ArbitrageSession;
use App\Traits\SendMessages;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class Exchange2ExchangeService implements ServiceInterface
{
    use SendMessages;
    protected $apiKey;
    protected $apiUrl;
    private $exchanges;
    public $telegrambot;
    public $arbitrage_found = false;

    public function __construct()
    {
        $this->exchanges = Config::get("exchanges");
        $this->telegrambot = new TelegramBotService();
    }

    public function continueBotSession($user_id, $user_session, $user_response = "")
    {
        // Fetch the current session data for the user
        $user_session_data = $user_session->getUserSessionData();
        $step = $user_session_data['step'] ?? null;

        $user = UserService::fetchUserByTgID($user_id);
        $responses = rand(10, 15);
        $arbitrage_session = ArbitrageSession::firstOrCreate(
            ['user_id' => $user->id],
            ['restart_timer' => time() + 86400, 'number_of_response_left' => $responses, "total_responses" => $responses]
        );

        // Check if the user's daily limit is reached or reset timer if needed
        if (time() >= $arbitrage_session->restart_timer) {
            $arbitrage_session->restart_timer = time() + 86400; // Reset the timer for the next day
            $responses = rand(10, 15);
            $arbitrage_session->number_of_response_left = $responses; // Reset the response count
            $arbitrage_session->total_responses = $responses; // Reset the response count
            $arbitrage_session->save();
        }

        if ($arbitrage_session->number_of_response_left <= 0) {
            $this->telegrambot->sendMessageToUser($user_id, "You have reached your daily limit for using Exchange2Exchange API Binding.");
            $user_session->endSession();
            return;
        }

        // $arbitrage_session->number_of_response_left--;
        // $arbitrage_session->save();

        if ($step == "check pair arbitrage") {
            $pairs = explode("/", $user_response);
            if (count($pairs) != 2) {
                $this->telegrambot->sendMessageToUser($user_id, "Invalid pair format. Please enter in format BTC/USD.");
                return;
            }

            $pair_one = strtoupper($pairs[0]);
            $pair_two = strtoupper($pairs[1]);

            // PROMPTING USER THAT API SEARCHIN IS GOING ON
            $msg = "🔎 Searching... ";
            $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
            sleep(rand(3,10));
            $this->telegrambot->deletMessages($msg_response,$user_id);

            $msg = "🔊 Scanning price volatility difference for $user_response ";
            $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
            sleep(rand(3,12));
            $this->telegrambot->deletMessages($msg_response,$user_id);

            $msg = "🔊 Scanning price volatility difference for $user_response ";
            $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
            sleep(rand(3,9));
            $this->telegrambot->deletMessages($msg_response,$user_id);

            $exchanges = $this->getRandomExchanges();

            foreach ($exchanges as $key => $value) {
                $msg = "🤖 Signaling {$value}";
                $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
                sleep(rand(1,4));
                $this->telegrambot->deletMessages($msg_response,$user_id);

            }

            //END  PROMPTING USER THAT API SEARCHIN IS GOING ON




            $pairs = "$pair_one/$pair_two";
            $responseMessage = $this->getArbitrageOpportunities($pairs, $user->id);

            if($this->arbitrage_found)
            {
                $msg = "🎯 Arbitrage Opportunity found...";
                $msg_response = $this->telegrambot->sendMessageToUser($user_id, $msg);
                sleep(rand(1,4));
                $this->telegrambot->deletMessages($msg_response,$user_id);

                $msg_response = $this->telegrambot->sendMessageToUser($user_id, $responseMessage);


                sleep(rand(60,110));
                $this->telegrambot->deletMessages($msg_response,$user_id);
                $user_session->endSession();

            }else {
                $msg_response = $this->telegrambot->sendMessageToUser($user_id, $responseMessage);
            }
           


            


        }
    }

    public function getArbitrageOpportunities($pair, $user_id){

        $arbitrageSession = ArbitrageSession::where('user_id', $user_id)->first();

        if (!$arbitrageSession || $arbitrageSession->number_of_response_left <= 0) {
            // Handle case where the user has no more responses left for the day
            return "You have reached your daily limit for arbitrage opportunities. Please try again tomorrow.";
        }

        $totalResponsesForToday = $arbitrageSession->total_responses; // Total responses assigned for today
        $responsesLeft = $arbitrageSession->number_of_response_left;

        // Calculate percentages based on remaining responses
        $errorJsonChance = round(0.2 * $totalResponsesForToday);
        $errorDataChance = round(0.2 * $totalResponsesForToday);
        $notFoundChance = round(0.1 * $totalResponsesForToday);
        $successChance = $responsesLeft - ($errorJsonChance + $errorDataChance + $notFoundChance);

        // Generate a random number within the range of remaining responses
        $randNumber = rand(1, $responsesLeft);

        // Decrement the number of responses left
        $arbitrageSession->number_of_response_left--;
        $arbitrageSession->save();

        if ($randNumber <= $errorJsonChance) {
            return "Error parsing JSON response.";
        } elseif ($randNumber <= ($errorJsonChance + $errorDataChance)) {
            return "Error fetching data for {$pair}: Trying to access array offset on value of type null.";
        } elseif ($randNumber <= ($errorJsonChance + $errorDataChance + $notFoundChance)) {
            return "🛑Arbitrage opportunity for {$pair} not found. Try the 'Swap Crypto' API feature.";
        } else {
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
            throw new \Exception("Failed to fetch price data.");
            return "Failed to fetch price data.";
        }

        // Calculate the sell price with a simulated profit margin
        $profitPercent = rand(10, 190) / 10; // 0.1% to 1.9%
        $sellPrice = $currentPrice * (1 + $profitPercent / 100);

        $currentPrice = number_format($currentPrice, 2);
        $sellPrice = number_format($sellPrice, 2);


        $this->arbitrage_found = true;
        return "🏆 ARBITRAGE OPPORTUNITY FOR {$pairs}\n"
            . "Buy on: Binance at \${$currentPrice}\n"
            . "Sell on: Kukoin at \${$sellPrice}\n"
            . "🥇Potential profit: {$profitPercent}%\n"
            . "⚠️ WARNING: Be aware that cryptocurrencies are subject to rapid price fluctuations.";
    }



    /**
     * Fetch the current price of a cryptocurrency in USD using cURL.
     *
     * @param string $cryptoCurrency The symbol of the cryptocurrency (e.g., 'BTC').
     * @return float|null The current price in USD or null if an error occurs.
     */
    public function fetchCryptoPriceInUSD($cryptoCurrency,$fiat)
    {
        $cryptoId = $this->getCryptoId($cryptoCurrency);

        if (!$cryptoId) {
            // Handle the case where the crypto ID is not found
            return null;
        }

        $url = "https://api.coingecko.com/api/v3/simple/price?ids={$cryptoId}&vs_currencies={$fiat}";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // Handle the error appropriately
            return null;
        }

        $data = json_decode($response, true);

        return $data[$cryptoId][$fiat] ?? null;
    }


    protected function loadCryptoData()
    {
        $filePath = public_path('crypto_id.json');

        // Check if the file exists
        if (!file_exists($filePath)) {
            throw new \Exception("Crypto data file not found.");
        }

        $jsonData = file_get_contents($filePath);
        $cryptoData = json_decode($jsonData, true);

        return $cryptoData;
    }

    public function getRandomExchanges() {
        // Ensure the array has more than 15 elements to pick from
       
        // Determine the number of elements to pick (between 7 and 15)
        $numElementsToPick = rand(7, 15);
    
        // Get random keys
        $randomKeys = array_rand($this->exchanges, $numElementsToPick);
    
        // Extract the values corresponding to the random keys
        $randomSubset = array_intersect_key($this->exchanges, array_flip($randomKeys));
    
        return $randomSubset;
    }

    public function getCryptoId($symbol)
    {
        $cryptoData =  $this->loadCryptoData();
        foreach ($cryptoData as $crypto) {
            if (strtoupper($crypto['symbol']) === strtoupper($symbol)) {
                return $crypto['id'];
            }
        }

        return null; // Return null if the symbol is not found
    }
}
