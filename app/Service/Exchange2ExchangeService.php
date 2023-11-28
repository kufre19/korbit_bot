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
            ['restart_timer' => time() + 86400, 'number_of_response_left' => $responses ,"total_responses"=>$responses]
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

            $pairs = "$pair_one/$pair_two";
            $responseMessage = $this->getArbitrageOpportunities($pairs,$user->id);
            $this->telegrambot->sendMessageToUser($user_id, $responseMessage);
        }
    }

    public function getArbitrageOpportunities($pair, $user_id)
    {
    
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
    
    private function simulateArbitrageOpportunity($pair)
    {
        // Extract the base and quote currencies from the pair
        [$baseCurrency, $quoteCurrency] = explode('/', $pair);
    
        if ($quoteCurrency !== 'USD') {
            // Handle cases where the quote currency is not USD
            return "Currently, only pairs with USD as the quote currency are supported.";
        }
    
        // Fetch the current price for the base currency in terms of USD
        $currentPrice = $this->fetchCurrentPrice($baseCurrency);
    
        // Calculate the sell price with a simulated profit margin
        $profitPercent = rand(10, 190) / 10; // 0.1% to 1.9%
        $sellPrice = $currentPrice * (1 + $profitPercent / 100);

        $currentPrice = number_format($currentPrice,2);
        $sellPrice = number_format($sellPrice,2);

    
        return "🏆 ARBITRAGE OPPORTUNITY FOR {$pair}\n"
            . "Buy on: Binance at \${$currentPrice}\n"
            . "Sell on: Kukoin at \${$sellPrice}\n"
            . "🥇Potential profit: {$profitPercent}%\n"
            . "⚠️ WARNING: Be aware that cryptocurrencies are subject to rapid price fluctuations.";
    }
    
    private function fetchCurrentPrice($currency)
    {
        // Make an HTTP request to Blockchain.com API for BTC and convert to the required currency
        // $btcToCurrencyUrl = "https://blockchain.info/tobtc?currency={$currency}&value=1";
        // $btcResponse = file_get_contents($btcToCurrencyUrl);
    
        // if ($btcResponse === false) {
        //     // Handle the error appropriately
        //     throw new \Exception("Failed to fetch current price for {$currency}.");
        // }
    
        // Convert the response to the required currency, assuming 1 BTC to USD rate
        // $btcToUsd = $this->fetchBtcToUsd(); // Implement this method to get BTC to USD conversion rate
        // return 1 / $btcResponse * $btcToUsd; // Convert from BTC to the required currency

        return 326000;
    }
    
    private function fetchBtcToUsd()
    {
        // Fetch the current BTC to USD conversion rate
        // Implement the logic to fetch this data, e.g., from another API or a stored value
        // For this example, we'll return a simulated rate
        return 20000; // Example rate, replace with actual data fetching logic
    }
    
}
