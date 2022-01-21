<?php

use GuzzleHttp\Client;

use Stripe\Stripe;
use Laravel\Cashier\Subscription;
use Laravel\Cashier\SubscriptionItem;

use App\Models\PaypalSubscription;
use App\Models\PaypalSubscriptionItem;
use App\User;
use Carbon\Carbon;

function user_is_subscribed(){

	$paypal = PaypalSubscription::where('user_id',auth()->user()->id)->where('paypal_status','=','active')->where(function($query){
		$query->where('ends_at','>',Carbon::today())->orWhere('ends_at',NULL);
	})->get();

	$stripe = Auth::user()->subscriptions()->active()->get();
	$both = $paypal->merge($stripe);

	if ($both->count() > 0) {
		return true;
	}else{
		return false;
	}

}

function get_user_is_subscribed(){

	$paypal = PaypalSubscription::where('user_id',auth()->user()->id)->where('paypal_status','=','active')->where(function($query){
		$query->where('ends_at','>',Carbon::today())->orWhere('ends_at',NULL);
	})->get();

	$stripe = Auth::user()->subscriptions()->active()->orderBy('created_at', 'desc')->get();

	$both = $paypal->merge($stripe);

	return $both;

}

function user_is_onGracePeriod(){

	$stripe = Auth::user()->subscriptions()->active()->where('ends_at','!=',NULL)->where('ends_at','>',Carbon::today())->get();
	$paypal = PaypalSubscription::where('user_id',auth()->user()->id)->where('paypal_status','=','active')->where('ends_at','!=',NULL)->where('ends_at','>',Carbon::today())->get();

	$both = $paypal->merge($stripe);

	if ($both->count() > 0) {
		return true;
	}else{
		return false;
	}
}

function cancel_user_subscription(){

		$subscription = get_user_is_subscribed()->first();

        switch ($subscription->payment_method) {
            case 'Stripe':

                Stripe::setApiKey(env('STRIPE_SECRET'));
                $stripe_name = $subscription->name;
                auth()->user()->subscription($stripe_name)->cancel();

            break;
            case 'Paypal':

                $client = new Client();

                $bearer_token = paypal_bearer_token();

                $response = $client->request(
                    'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
                    'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/'.$subscription->paypal_id,
                    ['headers' => ['Authorization' => "Bearer {$bearer_token}"]]
                );

                $subscription_details = json_decode($response->getBody());

                $subscription->update([
                    'ends_at'=>Carbon::parse($subscription_details->billing_info->next_billing_time)
                ]);

                $response = $client->request(
                    'POST', /*instead of POST, you can use GET, PUT, DELETE, etc*/
                    'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/'.$subscription_details->id.'/suspend',
                    ['headers' => 
                        [
                            'Content-Type'=>"application/json",
                            'Authorization' => "Bearer {$bearer_token}"
                        ]
                    ]
                );

            break;
            default:

            return response()->json(['message' => 'There was an issue with cancel_user_subscription 8331'],404);

            break;
        }

}

function resume_user_subscription(){

		$subscription = get_user_is_subscribed()->first();

        switch ($subscription->payment_method) {
            case 'Stripe':

                Stripe::setApiKey(env('STRIPE_SECRET'));

                $stripe_name = $subscription->name;

                auth()->user()->subscription($stripe_name)->resume();

            break;
            case 'Paypal':

                $client = new Client();

                $bearer_token = paypal_bearer_token();

                $response = $client->request(
                    'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
                    'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/'.$subscription->paypal_id,
                    ['headers' => ['Authorization' => "Bearer {$bearer_token}"]
                    ]
                );

                $subscription_details = json_decode($response->getBody());

                $response = $client->request(
                    'POST', /*instead of POST, you can use GET, PUT, DELETE, etc*/
                    'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/'.$subscription_details->id.'/activate',
                    ['headers' => 
                        [
                            'Content-Type'=>"application/json",
                            'Authorization' => "Bearer {$bearer_token}"
                        ]
                    ]
                );

                $subscription->update([
                    'ends_at'=>null
                ]);

            break;
            default:
            return response()->json(['message' => 'There was an issue with resume_user_subscription 7331'],404);
            break;
}

}