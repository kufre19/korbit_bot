<?php

namespace App\Service;

use App\Traits\SendMessages;
use Illuminate\Support\Facades\Http;

class Exchange2ExchangeService 
{
    use SendMessages;
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = env('CRYPTO_ARBITRAGE_API_KEY');
        $this->apiUrl = 'https://rapidapi.com/WRT/api/crypto-arbitrage'; // Replace with actual API URL
    }

    /**
     * Fetch arbitrage opportunities for specified pairs.
     *
     * @return string Formatted message with arbitrage opportunities
     * 
     */
    public function getArbitrageOpportunities()
    {
        try {
            $response = Http::withHeaders([
                'x-rapidapi-key' => $this->apiKey,
                'x-rapidapi-host' => parse_url($this->apiUrl, PHP_URL_HOST)
            ])->get($this->apiUrl); // Add necessary query parameters as per API

            if ($response->successful()) {
                return $this->formatArbitrageData($response->json());
            } else {
                throw new \Exception("Error fetching data from API.");
            }
        } catch (\Exception $e) {
            return "Failed to retrieve arbitrage data: " . $e->getMessage();
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

        if (!empty($data['warning'])) {
            $message .= "\n⚠️ Warning: " . $data['warning'];
        }

        return $message;
    }

}
