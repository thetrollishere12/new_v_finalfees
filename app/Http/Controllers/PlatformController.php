<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlatformRequest;


class PlatformController extends Controller
{
    
    public function send_request(Request $req){

        foreach ($req->array as $key => $value) {
            $platform = new PlatformRequest;
            $platform->status =  $value["status"];
            $platform->platform = $req->platform;
            $platform->type = $value["type"];
            $platform->name = $value["name"];
            $platform->amount = $value["value"];
            $platform->save();
        }

    }

}
