<?php

namespace App\Service;

interface ServiceInterface{
    public function continueBotSession($user_id, $user_session, $user_response = "");

}