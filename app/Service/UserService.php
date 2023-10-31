<?php

namespace App\Service;

use App\Models\User;
use App\Models\Wallet;


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
            $user = User::create([
                "tg_id"=>$user_id
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
}