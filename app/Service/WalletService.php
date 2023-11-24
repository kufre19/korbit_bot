<?php

namespace App\Service;

use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Cryptomus\Api\Client;

class WalletService
{
    /**
     * Withdraw funds from the user's wallet.
     * 
     * @param int $user_id
     * @param string $asset ('busd', 'dai', or 'usdt')
     * @param float $amount
     * @return bool
     */
    public function withdraw($user_id, $asset, $amount)
    {
        // Ensure the asset type is valid
        if (!in_array($asset, ['busd', 'dai', 'usdt'])) {
            return false;
        }

        // Start transaction
        DB::beginTransaction();
        try {
            $wallet = Wallet::where('user_id', $user_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found.");
            }

            $balanceField = 'balance_' . strtolower($asset);
            if ($wallet->$balanceField < $amount) {
                throw new \Exception("Insufficient funds.");
            }

            // Deduct the amount from the wallet
            $wallet->$balanceField -= $amount;
            $wallet->save();

            // Here you can add additional logic for the withdrawal process
            // such as logging the transaction, notifying the user, etc.

            // Commit the transaction
            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Rollback the transaction in case of any failure
            DB::rollBack();
            return false;
        }
    }

     /**
     * Get balance for the user's wallet.
     *
     * @param int $tg_id Telegram ID of the user
     * @return array
     */
    public function getBalance($tg_id)
    {
        // Assuming the User model is linked to the Wallet model with a one-to-one relationship
        $user = UserService::fetchUserByTgID($tg_id);
        if ($user && $user->wallet) {
            // Returning the balance as an array
            return [
                'busd' => $user->wallet->balance_busd,
                'dai' => $user->wallet->balance_dai,
                'usdt' => $user->wallet->balance_usdt,
            ];
        }

        // Return zeros if the wallet is not found
        return [
            'busd' => 0,
            'dai' => 0,
            'usdt' => 0,
        ];
    }

     /**
     * Get formatted balance for the user's wallet.
     *
     * @param int $tg_id Telegram ID of the user
     * @return string
     */
    public function getFormattedBalance($tg_id)
    {
        $balance = $this->getBalance($tg_id);

        // Create a formatted string for the message
        $formattedBalance = "💼 *Your Wallet Balance:*\n" .
                            "-----------------------\n" .
                            "🪙 *BUSD*: " . number_format($balance['busd'], 4) . "\n" .
                            "🪙 *DAI*: " . number_format($balance['dai'], 4) . "\n" .
                            "🪙 *USDT*: " . number_format($balance['usdt'], 4) . "\n";

        return $formattedBalance;
    }

     /**
      * Update balance for the user's wallet.
      * 
      * @param int $user_id
      * @param string $asset ('busd', 'dai', or 'usdt')
      * @param float $amount
      * @return bool
      */
      public function updateBalance($user_id, $asset, $amount)
      {
          // Ensure the asset type is valid
          if (!in_array($asset, ['busd', 'dai', 'usdt'])) {
              return false;
          }
  
          // Start transaction
          DB::beginTransaction();
          try {
              $wallet = Wallet::where('user_id', $user_id)->lockForUpdate()->first();
              if (!$wallet) {
                  throw new \Exception("Wallet not found.");
              }
  
              $balanceField = 'balance_' . strtolower($asset);
  
              // Add the amount to the wallet
              $wallet->$balanceField += $amount;
              $wallet->save();
  
              // Here you can add additional logic such as logging the transaction, notifying the user, etc.
  
              // Commit the transaction
              DB::commit();
              return true;
          } catch (\Exception $e) {
              // Rollback the transaction in case of any failure
              DB::rollBack();
              return false;
          }
      }
}
