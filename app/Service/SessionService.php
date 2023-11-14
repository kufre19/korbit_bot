<?php

namespace App\Service;

use App\Models\Session;
use App\Service;

class SessionService
{
    public $tg_user_id;
    public $user_session_data;
    public $user_session_status;


    public function __construct($tg_user_id)
    {
        $this->tg_user_id = $tg_user_id;
    }



    public function start_new_session()
    {
        $data = [];
        $json = json_encode($data);
        $model = new Session();
        $model->user_id = $this->tg_user_id;
        $model->session_data = $json;
        $model->timeout = time() + 3600;
        $model->active_status = "yes";
        $model->save();
    }

    public function update_session($data = null)
    {
        if ($data == null) {
            $data = [];
            $data = json_encode($data);
        } else {
            $data = json_encode($data);
        }

        $model = new Session();
        $model->where('user_id', $this->tg_user_id)
            ->update([
                'session_data' => $data,
                'timeout' => time() + 3600
            ]);

        $this->fetch_user_session();
    }

    public function fetch_user_session()
    {
        $model = new Session();
        if ($this->did_session_expired()) {

            $model = new Session();
            $fetch = $model->where('user_id', $this->tg_user_id)->first();
            $this->user_session_data = json_decode($fetch->session_data, true);
        } else {

            $fetch = $model->where('user_id', $this->tg_user_id)->first();
            $this->user_session_data = json_decode($fetch->session_data, true);
        }
    }

    public function did_session_expired()
    {
        $model = new Session();
        $fetch = $model->select('timeout')->where('user_id', $this->tg_user_id)->first();

        if (!$fetch) {
            $this->user_session_status = 0;
            return $this->start_new_session();
        } elseif ($fetch->timeout < time()) {
            $this->user_session_status = "no";
            return true;
        } else {
            $this->user_session_status = "yes";
        }
    }

    public function add_command_to_session($data = null)
    {
        if ($data == null) {
            $this->user_session_data['active_command'] = array();
        } else {
            $this->user_session_data['active_command'] = $data;
        }
        $this->update_session($this->user_session_data);
    }

    public function add_value_to_session($key = "", $value = "")
    {
        if ($key == "") {
            array_push($this->user_session_data, $value);
            $this->update_session($this->user_session_data);
        } else {
            $this->user_session_data[$key] = $value;
            $this->update_session($this->user_session_data);
        }
    }

    public function startSessionCommand()
    {
        $session_data = [
            "step_name" => "",
            "answered_questions" => [],
            "active_command" => "no",
            "form_counter" => 0,
            "step" => ""

        ];


        $this->update_session($session_data);
    }

    public function set_session_route($name, $steps)
    {

        // if (isset($this->user_session_data['active_command'])) {
        //     if ($this->user_session_data['active_command'] == "yes") {
        //         $this->change_route_name($name, $steps);
        //     }
        // } else {
        //     $session_data = [
        //         "step_name" => $name,
        //         "answered_questions" => [],
        //         "active_command" => "yes",
        //         "form_counter" => 0,
        //         "step" => $steps

        //     ];

        //     return $this->update_session($session_data);
        // }

        $session_data = [
            "step_name" => $name,
            "answered_questions" => [],
            "active_command" => "yes",
            "form_counter" => 0,
            "step" => $steps

        ];

        return $this->update_session($session_data);
    }

    public function change_route_name($route_name, $steps)
    {
        $this->user_session_data["step_name"] = $route_name;
        $this->user_session_data["step"] = $steps;

        $this->update_session($this->user_session_data);
    }

    public function getUserSessionData()
    {
        $this->fetch_user_session();
        // $this->startSessionCommand();
        return $this->user_session_data;
    }

    // Within the SessionService class...

    public function endSession()
    {
        // Set the session status to inactive
        $this->add_value_to_session('active_status', 'no');

        // Optionally clear the session data
        $this->add_value_to_session('session_data', []);

        // You might also want to perform other cleanup operations,
        // such as logging the session end or notifying the user.
    }


    public function run_action_session($user_response = "")
    {
        $this->fetch_user_session(); // Ensures the current session data is fetched
        $action_name = $this->user_session_data['step_name'];



        // Append namespace if not already present
        $full_class_name = (strpos($action_name, '\\') === false) ? "App\\Service\\" . $action_name : $action_name;

        if (class_exists($full_class_name)) {
            $call_Action = new $full_class_name();
            if (method_exists($call_Action, 'continueBotSession')) {
                $call_Action->continueBotSession($this->tg_user_id, $this, $user_response);
            } else {
                // Handle the case where the method doesn't exist
            }
        } else {
            // Handle the case where the class doesn't exist
        }
    }
}
