<?php

namespace App\Service;

use App\Models\User;

class UserService{


    public static function updateUserEmail($user_id,$email)
    {
       return  User::where('tg_id',$user_id)->update([
            "email"=>$email
        ]);
    }

    public static function registeredNewUser($user_id,)
    {
        $user = User::where("tg_id",$user_id)->first();
        if(!$user)
        {
            User::create([
                "tg_id"=>$user_id
            ]);
        }

        // Check if the user already has a wallet
        if (!$user->wallet) {
            // Create a new wallet for the user with 0 balance for each asset
            $user->wallet()->create([
                'balance_busd' => 0,
                'balance_dai' => 0,
                'balance_usdt' => 0
            ]);
        }
        return true;
        

    }
}