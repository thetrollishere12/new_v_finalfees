<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Mail\Message;
use ReCaptcha\ReCaptcha;
use Redirect;
use Session;
use Mail;
use Carbon\Carbon;
use GuzzleHttp\Client;

use App\Models\User;
use App\Models\Sale;
use Laravel\Cashier\Subscription;
use Laravel\Cashier\SubscriptionItem;

class AccountController extends Controller
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

    public function index(){
        $sales = Sale::where('user_id', '=', Auth::id());

        $sum = array(
            "sold"=>$sales->sum('sold_price')+$sales->sum('shipping_charge'),
            "cost"=>$sales->sum('item_cost')+$sales->sum('shipping_cost'),
            "fees"=>$sales->sum('fees')+$sales->sum('other_fees')+$sales->sum('processing_fees')+$sales->sum('tax'),
            "profit"=>$sales->sum('profit')

        );
        return view('account.home')->with(['page'=>'login','sum'=>$sum]);
    }

    public function settings(){
         $subscription = Subscription::where('user_id', '=',auth()->user()->id)->orderBy('created_at', 'desc')->first();
        return view('account.settings')->with(['page'=>'settings','subscription'=>$subscription]);
    }

    public function subscription(){

        $page = "subscription";
   
        if (user_is_subscribed()) {
            
            $subscription = get_user_is_subscribed()->first();

            switch ($subscription->payment_method) {
                case 'Stripe':

                    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                    $id = $subscription->stripe_id;

                    $account = \Stripe\Subscription::retrieve($id);
                    
                    return view('account.subscription')->with([
                        'page'=>$page,
                        'subscription'=>$subscription,
                        'user'=>auth()->user(),
                        'period_end'=>$account->current_period_end,
                        'period_valid'=>$account->current_period_start,
                        'amount'=>$account->plan->amount,
                        'active'=>$account->plan->active,
                        'cancel'=>$account->cancel_at_period_end
                    ]);

                    break;
                case 'Paypal':
                    
                    $client = new Client();

                    $bearer_token = paypal_bearer_token();

                    $response = $client->request(
                        'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
                        'https://api-m.sandbox.paypal.com/v1/billing/subscriptions/'.$subscription->paypal_id,
                        ['headers' => 
                            [
                                'Authorization' => "Bearer {$bearer_token}"
                            ]
                        ]
                    );

                    $subscription_details = json_decode($response->getBody());

                    return view('account.subscription')->with([
                        'page'=>$page,
                        'subscription'=>$subscription,
                        'user'=>auth()->user(),
                        'details'=>$subscription_details,
                        'period_end'=>Carbon::parse($subscription_details->billing_info->last_payment->time)->addDays(30),
                        'period_valid'=>$subscription_details->billing_info->last_payment->time,
                        'amount'=>str_replace('.','',$subscription_details->billing_info->last_payment->amount->value),
                        'active'=>$subscription_details->status,
                        'cancel'=>$subscription_details->status
                    ]);

                    break;
                default:
                    return view('account.subscription')->with([
                        'page'=>$page,
                        'user'=>auth()->user(),
                    ]);
                    break;
            }

        }else{

            return view('account.subscription')->with([
                'page'=>$page,
                'user'=>auth()->user(),
            ]);

        }
    }

    public function editpayment(){
        $page = 'editpayment';

        $id = auth()->user()->id;
        $sub = User::where('id', '=', $id)->stripe_id;

        if (!empty($sub)) {
            return view('account.editpayment',['page'=>$page]);
        }else{
            return redirect('/subscription');
        }
    }

    public function change_tax(Request $request){
        if ($request->ajax()) {

            $validator = \Validator::make($request->all(), [
                'user_id' => 'required',
                'tax'=>'required'
            ]);

            if (!$validator->fails()) {
                if ($request->user_id == Auth::id()) {
                 
                    $save = new User;
                    $save = User::find(Auth::id());
                    $save->tax = $request->tax;
                    $save->save();
                    if ($save) {
                        return "success";
                    }else{
                        return "error";
                    }
                }
            }
        }
    }

    public function suggestion(Request $request){

        $recaptcha = new ReCaptcha(env('GOOGLE_RECAPTCHA_SECRET_KEY'));
        $response = $recaptcha->verify($request->get('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

        if ($response->isSuccess()) {
        
            if (!empty($request->textarea)) {
                Mail::to("brandonsanghuynh123@gmail.com")->send(new message($request));
                Session::flash('message','Email Sent');
                return redirect('/subscription');
            }else{
                return redirect('/subscription');
            }

        }else{
            return Redirect::back()->withErrors(['Please Complete', 'The Message']);
        }

    }


}
