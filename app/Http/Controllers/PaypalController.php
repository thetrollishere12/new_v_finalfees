<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\PaypalSubscription;
use App\Models\PaypalSubscriptionItem;


class PaypalController extends Controller
{

	public function paypal_sub_approved(Request $req){
		
		$client = new Client();

    	$bearer_token = paypal_bearer_token();

		$response = $client->request(
		    'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
		    'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/'.$req->sub_id,
		    ['headers' => 
		        [
		            'Authorization' => "Bearer {$bearer_token}"
		        ]
		    ]
		);


		$data = json_decode($response->getBody());

		if ($data->status === 'ACTIVE' && $req->sub_id === $data->id) {

			 DB::table('users')->where('id', '=', Auth::id())->update([
                'paypal_payer_id'=>$data->subscriber->payer_id,
                'paypal_email'=>$data->subscriber->email_address
            ]);

			 $sub = new PaypalSubscription;
			 $sub->user_id = auth()->user()->id;
			 $sub->payment_method = "Paypal";
			 $sub->name = "Main";
			 $sub->paypal_id = $data->id;
			 $sub->paypal_status = "active";
			 $sub->paypal_plan = $data->plan_id;
			 $sub->quantity = $data->quantity;
			 $sub->save();

			 $item = new PaypalSubscriptionItem;
			 $item->subscription_id = $sub->id;
			 $item->paypal_id = $data->id;
			 $item->paypal_product = "Premium Account";
			 $item->paypal_plan = $data->plan_id;
			 $item->quantity = $data->quantity;
			 $item->save();


		}else{
			return "error with paypal";
		}


	}

}
