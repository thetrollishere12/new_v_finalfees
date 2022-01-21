<?php

use GuzzleHttp\Client;

function paypal_bearer_token(){

	$client = new Client();
	
	$response = $client->request(
        'POST',
        'https://api-m.sandbox.paypal.com/v1/oauth2/token?grant_type=client_credentials',
        ['auth' => [env('PAYPAL_CLIENT_ID'),env('PAYPAL_SECRET_ID')]] 
    );

    return json_decode($response->getBody())->access_token;

}