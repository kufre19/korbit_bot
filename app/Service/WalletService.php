<?php

namespace App\Service;

use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

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
}
