<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BotController extends Controller
{
    public function __construct(Request $request)
    {

       
          $data = json_encode($request->all());
            $file = time() .rand(). '_file.json';
            $destinationPath=public_path()."/upload/";
            if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
            File::put($destinationPath.$file,$data);
            die;
    }

    public function index()
    {
        return response("ok");
    }
}
