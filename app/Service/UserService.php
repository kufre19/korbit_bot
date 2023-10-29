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
        User::create([
            "tg_id"=>$user_id
        ]);
    }
}