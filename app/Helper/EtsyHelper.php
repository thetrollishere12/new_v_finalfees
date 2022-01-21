<?php

use Illuminate\Support\Facades\Http;

function etsy_get_user($token,$id){

    $response = Http::withHeaders([
        'x-api-key'=>env('ETSY_KEYSTRING'),
        'authorization'=>'Bearer '.$token
    ])->get('https://openapi.etsy.com/v3/application/users/'.$id);

    return json_decode($response->getBody());

}

function etsy_get_shop_by_userid($id){

    $response = Http::withHeaders([
        'x-api-key'=>env('ETSY_KEYSTRING')
    ])->get('https://openapi.etsy.com/v3/application/users/'.$id.'/shops');

    return json_decode($response->getBody());

}

function etsy_receipt($token,$shop_id,$min,$max,$limit,$offset){

    $response = Http::withHeaders([
        'x-api-key'=>env('ETSY_KEYSTRING'),
        'authorization'=>'Bearer '.$token
    ])->get('https://openapi.etsy.com/v3/application/shops/'.$shop_id.'/receipts?min_created='.$min.'&max_created='.$max.'&limit='.$limit."&offset=".$offset);

    return json_decode($response->getBody());

}

function etsy_receipt_by_id($token,$shop_id,$id){

    $response = Http::withHeaders([
        'x-api-key'=>env('ETSY_KEYSTRING'),
        'authorization'=>'Bearer '.$token
    ])->get('https://openapi.etsy.com/v3/application/shops/'.$shop_id.'/receipts/'.$id.'/payments');

    return json_decode($response->getBody());

}

function etsy_ledger_entry($token,$shop_id,$min,$max,$limit,$offset){

    $response = Http::withHeaders([
        'x-api-key'=>env('ETSY_KEYSTRING'),
        'authorization'=>'Bearer '.$token
    ])->get('https://openapi.etsy.com/v3/application/shops/'.$shop_id.'/payment-account/ledger-entries?min_created='.$min.'&max_created='.$max.'&limit='.$limit."&offset=".$offset);

    return json_decode($response->getBody());

}

function etsy_get_listings_by_shop($token,$shop_id,$state,$limit,$offset,$sort_on,$sort_order){

    $response = Http::withHeaders([
        'x-api-key'=>env('ETSY_KEYSTRING'),
        'authorization'=>'Bearer '.$token
    ])->get('https://openapi.etsy.com/v3/application/shops/'.$shop_id.'/listings?state='.$state.'&limit='.$limit."&offset=".$offset."&sort_on=".$sort_on."&sort_order=".$sort_order);

    return json_decode($response->getBody());

}

function etsy_get_listings_image_by_id($shop_id,$id){

    $response = Http::withHeaders([
        'x-api-key'=>env('ETSY_KEYSTRING')
    ])->get('https://openapi.etsy.com/v3/application/shops/'.$shop_id.'/listings/'.$id.'/images');

    return json_decode($response->getBody());

}

function etsy_get_listings_image_by_image_id($shop_id,$id,$image_id){

    $response = Http::withHeaders([
        'x-api-key'=>env('ETSY_KEYSTRING')
    ])->get('https://openapi.etsy.com/v3/application/shops/'.$shop_id.'/listings/'.$id.'/images/'.$image_id);

    return json_decode($response->getBody());

}