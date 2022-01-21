<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Spreadsheet;
use App\Models\Sale;
use Auth;
use Billable;
use Stripe;
use Illuminate\Support\Facades\Redirect;
use DB;
use GuzzleHttp\Client;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function payment_page(Request $req){

        if (user_is_subscribed()) {

            return redirect('/subscription');

        }else{

            return view('payment.payment');
        }

    }

    public function payment(Request $request){

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentMethod  = $request->paymentMethod;

            $user = auth()->user();

            $user->newSubscription('main', env('STRIPE_PLAN_CODE'))->create($paymentMethod,[
                'email'=>$user->email
            ]);

            Subscription::where('user_id', '=', Auth::id())->update([
                'payment_method'=>'Stripe'
            ]);

            return redirect('/subscription')->with(['subscribed'=>'subbed']);

    }


    public function cancel_subscription(Request $request){

        cancel_user_subscription();
        return redirect('/subscription');

    }

    public function resume_subscription(Request $request){

        resume_user_subscription();
        return redirect('/subscription');

    }

    public function stripe_payment_subscription_update(Request $request){

        Auth::user()->updateDefaultPaymentMethod($request->paymentMethod);

        return Redirect(url('/subscription'))->with('success','Payment method has been updated.');

    }
}

