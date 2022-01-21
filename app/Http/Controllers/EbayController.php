<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class EbayController extends Controller
{


    public static function token_refresh($shop_id){

        // $account = EtsyAccount::where('parent_email',auth()->user()->email)->where('etsy_shop_id',$shop_id)->get()->first();

        // if ($account->count() > 0) {

        //     $client = new Client();

        //     $response = $client->request(
        //         'POST', /*instead of POST, you can use GET, PUT, DELETE, etc*/
        //         'https://api.etsy.com/v3/public/oauth/token',
        //         [
        //             'form_params' => [
        //                 'grant_type'=>'refresh_token',
        //                 'client_id'=>env('ETSY_KEYSTRING'),
        //                 'refresh_token'=>$account->refresh_token
        //             ],
        //         ] 
        //     );

        //     $new_oauth = json_decode($response->getBody());

        //     $account->update([
        //         'bearer_token'=>$new_oauth->access_token
        //     ]);

        //     return $new_oauth->access_token;

        // }else{
        //     return "account doesnt exist";
        // }


    }


    public function connect(Request $req){

        $client = new Client([
                'headers' => [
                    'Content-Type'=>'application/x-www-form-urlencoded',
                    'Authorization'=>'Basic '.base64_encode(env('EBAY_CLENT_APP_ID').':'.env('EBAY_CLENT_APP_SECRET')),
                ],
        ]);

        $response = $client->request(
            'POST',
            'https://api.sandbox.ebay.com/identity/v1/oauth2/token',
            [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $req->code,
                    'redirect_uri' => env('EBAY_REDIRECT_URI'),
                ]
            ] 
        );

        $output = json_decode($response->getBody());

        dd($output);


    }
}
