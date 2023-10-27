<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\TestService;

class WebController extends Controller
{
   public function confirm_payment(Request $request)
   {
        $user_email = $request->input("email");
   }
}
