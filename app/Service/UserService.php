<?php

namespace App\Service;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;



class UserService
{


    public static function updateUserEmail($user_id, $email)
    {
        return  User::where('tg_id', $user_id)->update([
            "email" => $email
        ]);
    }

    public static function registeredNewUser($user_id,)
    {
        $user = User::where("tg_id", $user_id)->first();
        if (!$user) {
            $referralCode = self::generateUniqueReferralCode();
            $user = User::create([
                "tg_id" => $user_id,
                "referral_code" => $referralCode
            ]);

            Wallet::create([
                'user_id' => $user->id,
                'balance_busd' => 0,
                'balance_dai' => 0,
                'balance_usdt' => 0
            ]);
        }


        return true;
    }

    private static function generateUniqueReferralCode()
    {
        do {
            $code = Str::random(10); // Generates a random string of 10 characters
        } while (User::where('referral_code', $code)->exists()); // Ensure the code is unique

        return $code;
    }

    /**
     * Check if a user with the given chat ID already exists in the database.
     *
     * @param int $chatId The chat ID of the user.
     * @return bool True if the user already exists, false otherwise.
     */
    public static function isUserAlreadyCreated($chatId)
    {
        // Assuming 'chat_id' is the column name in your users table that stores the Telegram chat ID.
        return User::where('tg_id', $chatId)->exists();
    }

    public static function fetchUserByTgID($tg_id)
    {
        // Use the User model to query the database for a user with the given Telegram ID
        $user = User::where('tg_id', $tg_id)->first();
        
        // Check if a user was found
        if ($user) {
            // Return the user object if found
            return $user;
        } else {
            // Return null or handle the case where the user does not exist in the database
            // You might want to log this incident or throw an exception, depending on your use case
            return null;
        }
    }
    
}
