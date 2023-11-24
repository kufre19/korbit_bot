<?php

namespace App\Service;

use App\Traits\SendMessages;
use Illuminate\Support\Facades\Http;

class Exchange2ExchangeService
{
    use SendMessages;
    protected $apiKey;
    protected $apiUrl;
    private $exchanges = ['bitstamp', 'cex', 'exmo', 'hitbtc']; // Add more exchanges as needed

    public function __construct()
    {
        $this->apiKey = env('CRYPTO_ARBITRAGE_API_KEY');
        $this->apiUrl = 'https://rapidapi.com'; // Replace with actual API URL
    }

    /**
     * Fetch arbitrage opportunities for specified pairs.
     *
     * @return string Formatted message with arbitrage opportunities
     * 
     */
    public function getArbitrageOpportunities()
    {
        $pairs = ["BTC/USD", "DAI/USDT", "BUSD/DAI"]; // Add more pairs as needed
        $results = [];

        foreach ($pairs as $pair) {
            $result = $this->fetchArbitrageDataForPair($pair);
            if ($result) {
                $results[] = $result;
            }
        }

        
        return $results;
    }

    private function fetchArbitrageDataForPair($pair)
    {
        $curl = curl_init();

        $url = "https://crypto-arbitrage.p.rapidapi.com/crypto-arb";
        $queryParams = http_build_query([
            "pair" =>$pair,
            "consider_fees" => "False",
            "selected_exchanges" => "exmo cex bitstamp hitbtc"
        ]);

        curl_setopt_array($curl, [
            CURLOPT_URL => $url . "?" . $queryParams,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: crypto-arbitrage.p.rapidapi.com",
                "X-RapidAPI-Key: " . $this->apiKey
            ],
        ]);

        $response = curl_exec($curl);


        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return null; // Or handle the error as you see fit
        } else {
            $responseData = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $this->formatArbitrageData($responseData);
            } else {
                return null; // Or handle JSON parsing error
            }
        }
    }

    /**
     * Process and format the API response for arbitrage data.
     *
     * @param array $apiResponse The response from the Crypto Arbitrage API.
     * @param int $userId The user ID to send the message to.
     */
    public function processAndSendArbitrageInfo($apiResponse, $userId)
    {
        // Format the arbitrage data
        $formattedMessage = $this->formatArbitrageData($apiResponse);

        // Send the formatted message to the user
        $this->sendMessageToUser($userId, $formattedMessage);
    }

    /**
     * Format the arbitrage data from the API response.
     *
     * @param array $data The response data from the API.
     * @return string The formatted message.
     */
    private function formatArbitrageData($data)
    {
        $profit = $data['arbitrage_profit'];
        $profitPercentage = $profit * 100; // Convert to percentage

        $sellExchange = $data['order_sell']['exchange'];
        $sellPrice = number_format($data['order_sell']['bid'], 2);
        $sellFees = $data['order_sell']['fees'] * 100; // Convert to percentage

        $buyExchange = $data['order_buy']['exchange'];
        $buyPrice = number_format($data['order_buy']['ask'], 2);
        $buyFees = $data['order_buy']['fees'] * 100; // Convert to percentage

        $pair = $data['pair'];

        $profitOrLoss = $profit > 0 ? 'Profit' : 'Loss';

        $message = "🔄 Arbitrage Opportunity for {$pair}\n";
        $message .= "---------------------------------\n";
        $message .= "Sell on: {$sellExchange} at \${$sellPrice} (Fees: {$sellFees}%)\n";
        $message .= "Buy on: {$buyExchange} at \${$buyPrice} (Fees: {$buyFees}%)\n";
        $message .= "---------------------------------\n";
        $message .= "Potential {$profitOrLoss}: " . number_format($profitPercentage, 2) . "%\n";

        // if (!empty($data['warning'])) {
        //     $message .= "\n⚠️ Warning: " . $data['warning'];
        // }

        return $message;
    }
}
