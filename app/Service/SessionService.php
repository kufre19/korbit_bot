<?php

namespace App\Service;

class SessionService {
    public $tg_user_id;

    public function __construct($tg_user_id)
    {
        $this->tg_user_id = $tg_user_id;
    }

    public function start_new_session()
    {
        
    }
}