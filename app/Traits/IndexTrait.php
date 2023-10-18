<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait IndexTrait{

    public $commands ;

    public function userCommand($command)
    {

        // cheack first if command exists
        // if it does route to the right Traits(call the method from the trait)
        if($this->checkIfCommandExists($command))
        {

        }

    }



    public function checkIfCommandExists($command)
    {
        $commands = Config::get("botcommands.commands");
        if(!in_array($command,$commands))
        {
            return false;

        }
        return true;
    }
}