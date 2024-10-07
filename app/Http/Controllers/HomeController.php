<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view("home");
    }

    public function privacyPolicy()
    {
        return view("privacy-policy");
    }

    public function termsOfUse()
    {
        return view("terms-of-use");
    }
}
