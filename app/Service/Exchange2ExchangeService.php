<?php

namespace App\Service;

use App\Traits\SendMessages;
use Illuminate\Support\Facades\Http;

class Exchange2ExchangeService
{
    use SendMessages;
    protected $apiKey;
    protected $apiUrl;
    private $exchanges = ['bitstamp', 'cex', 'exmo', 'hitbtc']; // Add more exchanges as needed

    public function __construct()
    {
        
    }

    
   

   
  
}
