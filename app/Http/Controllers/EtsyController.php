<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\EtsyAccount;
use Carbon\Carbon;
use App\Expense;
use Illuminate\Support\Facades\Auth;
use App\Models\Spreadsheet;
use App\Models\Sale;



use Illuminate\Support\Str;


// Might delete
use Gentor\Etsy\Facades\Etsy;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Exception;
// 

class EtsyController extends Controller {


	public static function token_refresh($shop_id){

		$account = EtsyAccount::where('parent_email',auth()->user()->email)->where('etsy_shop_id',$shop_id)->get()->first();

		if ($account->count() > 0) {

			$client = new Client();

	        $response = $client->request(
	            'POST', /*instead of POST, you can use GET, PUT, DELETE, etc*/
	            'https://api.etsy.com/v3/public/oauth/token',
	            [
	                'form_params' => [
	                	'grant_type'=>'refresh_token',
	                	'client_id'=>env('ETSY_KEYSTRING'),
	                	'refresh_token'=>$account->refresh_token
	                ],
	            ] 
	        );

	        $new_oauth = json_decode($response->getBody());

	        $account->update([
	        	'bearer_token'=>$new_oauth->access_token
	        ]);

	        return $new_oauth->access_token;

		}else{
			return "account doesnt exist";
		}


	}

	public function index() {

		session()->put('state', $state = Str::random(40));

		session()->put(
	        'code_verifier', $code_verifier = Str::random(128)
	    );

		$codeChallenge = strtr(rtrim(base64_encode(hash('sha256', $code_verifier, true)), '='), '+/', '-_');

		$etsy_account = EtsyAccount::where('parent_email', '=', auth()->user()->email)->get();

		$type = 'etsy';

		return view('auto.etsy', compact('etsy_account','type','codeChallenge','state'))->with([
			'page' => 'etsy_account'
		]);

	}

	public function connect(Request $request) {

        try{

	        $client = new Client();

	        $response = $client->request(
	            'POST', /*instead of POST, you can use GET, PUT, DELETE, etc*/
	            'https://api.etsy.com/v3/public/oauth/token',
	            [
	                'form_params' => [

	                	'grant_type'=>'authorization_code',
	                	'client_id'=>env('ETSY_KEYSTRING'),
	                	'redirect_uri'=>env('ETSY_CALLBACK_URI'),
	                	'code'=>$request->code,
	                	'code_verifier'=>session('code_verifier')

	                ],
	            ] 
	        );


	        $oauth = json_decode($response->getBody());

	        $id = strtok($oauth->access_token, '.');

	        if(EtsyAccount::where('etsy_user_id',$id)->count() === 0){

	        	// Get SHOP DETAILS

		        $response = $client->request(
		            'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
		            'https://openapi.etsy.com/v3/application/users/'.$id.'/shops',
		            [
		                'headers' => [
		                	'x-api-key'=>env('ETSY_KEYSTRING'),
		                ],
		            ] 
		        );

		        // GET SHOP NAME, SHOP ID, URL, ICON, TRANSACTION SOLD, CURRENCY, COUNTRY
		        $decode = json_decode($response->getBody());

		        $user_email = $response = $client->request(
		            'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
		            'https://openapi.etsy.com/v3/application/users/'.$decode->user_id,
		            [
		                'headers' => [
		                	'x-api-key'=>env('ETSY_KEYSTRING'),
		                	'authorization'=>'Bearer '.$oauth->access_token
		                ],
		            ] 
		        );

		        $account = new EtsyAccount;
		        $account->etsy_email = json_decode($user_email->getBody())->primary_email;
		        $account->parent_email = auth()->user()->email;
		        $account->bearer_token = $oauth->access_token;
		        $account->refresh_token = $oauth->refresh_token;
		        $account->etsy_user_id = $decode->user_id;
		        $account->etsy_shop_id = $decode->shop_id;
		        $account->etsy_shop_name = $decode->shop_name;
		        $account->etsy_shop_url = $decode->url;
		        $account->etsy_shop_icon = $decode->icon_url_fullxfull;
		        $account->etsy_shop_transaction = $decode->transaction_sold_count;
		        $account->save();

		        return redirect('/auto/etsy');

			}else{
				return redirect('/auto/etsy?status=exist');
			}

        }catch(\Exception $e){
			return $e;
            return redirect(url('user/seller/payment-method'))->with('error','There was an Paypal error. Please try again.');

        }


	}

	public function account() {

		$etsy_account = EtsyAccount::where('parent_email', '=', auth()->user()->email)->get();

		return view('auto.widget.etsy_account', compact('etsy_account'))->render();

	}


	public function sold(Request $req,$shop_id){

		$limit = 50;

		if (!isset($req->page)OR $req->page == 0){$req->page = 1;}

		$page = ($req->page-1)*$limit;


		$etsy_account = EtsyAccount::where('parent_email', '=', auth()->user()->email)->where('etsy_shop_id',$shop_id)->get()->first();

		$new_bearer_token = $this->token_refresh($shop_id);

		$listings = [];

		$client = new Client();

		$response = $client->request(
            'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
            'https://openapi.etsy.com/v3/application/shops/'.$etsy_account->etsy_shop_id.'/receipts?limit='.$limit."&offset=".$page,
            [
                'headers' => [
                	'x-api-key'=>env('ETSY_KEYSTRING'),
                	'authorization'=>'Bearer '.$new_bearer_token
                ],
            ] 
        );

        $solds = json_decode($response->getBody());

        foreach($solds->results as $sold){

        	$response = $client->request(
	            'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
	            'https://openapi.etsy.com/v3/application/shops/'.$etsy_account->etsy_shop_id.'/receipts/'.$sold->receipt_id.'/payments',
	            [
	                'headers' => [
	                	'x-api-key'=>env('ETSY_KEYSTRING'),
	                	'authorization'=>'Bearer '.$new_bearer_token
	                ],
	            ] 
	        );

        	foreach ($sold->transactions as $i => $transaction) {
        		
        		try{

		        	$response_img = $client->request(
			            'GET', /*instead of POST, you can use GET, PUT, DELETE, etc*/
			            'https://openapi.etsy.com/v3/application/shops/'.$etsy_account->etsy_shop_id.'/listings/'.$transaction->listing_id.'/images/'.$transaction->listing_image_id,
			            [
			                'headers' => [
			                	'x-api-key'=>env('ETSY_KEYSTRING')
			                ],
			            ] 
			        );

		        	$sold->transactions[$i]->image = json_decode($response_img->getBody())->url_75x75;

	        	}catch(\Exception $e){
	        		continue;
	        	}

        	}

        	$listings[] = [
        		"receipt"=>$sold,
        		"payments"=>json_decode($response->getBody())->results[0]
        	];

        }

    	$pagination = [
    		'current_page'=>$req->page,
    		'total_page' => $solds->count/$limit
    	];

        return view('auto.etsy_sold',['listings'=>$listings,'listing_count'=>$solds->count,'pagination'=>$pagination,'o'=>0]);

	}

	public function addSoldListing(Request $request){

        if (empty($request->fee_array)) {
        	return response()->json(['message'=>'Please Check A Checkbox','color'=>'#ea3f4f','text'=>'white']);
        }

        $spreadsheet_id = $request->spreadsheet_id;

        if(isset($spreadsheet_id)){

        	$count = Spreadsheet::where('user_id', '=', Auth::id())->where('spreadsheet_id', '=', $spreadsheet_id)->count();

            $sales_count = DB::table('sales')->where('user_id', '=', Auth::id())->count();

        }
      
        foreach($request->fee_array as  $listing){
    
                if ($count > 0) {
                    $sale = new Sale;
                    $sale->user_id = Auth::id();
                    $sale->sales_id = $listing['sale_id'];
                    $sale->item_id = $listing['item_id'];
                    $sale->spreadsheet_id = $spreadsheet_id;
                    $sale->sale_date = Carbon::parse($listing['date'])->format('Y-m-d');
                    $sale->platform = $listing['platform'];
                    $sale->quantity = $listing['quantity'];
                    $sale->name = $listing['name'];
                    $sale->currency = $listing['currency'];
                    $sale->sold_price = ($listing['sold_price']) ? $listing['sold_price'] : 0;
                    $sale->item_cost = ($listing['item_cost']) ? $listing['item_cost'] : 0;
                    $sale->shipping_charge = ($listing['shipping_charge']) ? $listing['shipping_charge'] : 0;
                    $sale->shipping_cost = ($listing['shipping_cost']) ? $listing['shipping_cost'] : 0;
                    $sale->fees = ($listing['fees']) ? $listing['fees']: 0;
                    $sale->other_fees =  ($listing['other_fees']) ? $listing['other_fees'] : 0;
                    $sale->processing_fees = ($listing['processing_fees']) ? $listing['processing_fees'] : 0;
                    $sale->tax = ($listing['tax']) ? $listing['tax'] : 0;
                    $sale->profit = ($listing['profit']) ? $listing['profit'] : 0;
    
                    if (Auth::user()->subscribed('main')) {
                        $sale->save();
                        return response()->json(['status'=>'valid','message'=>'Added To Spreadsheet','color'=>'#d4edda','text'=>'#262626']);
                    } else{
                        if ($sales_count < 25) {
                            $sale->save();
                            return response()->json(['status'=>'valid','message'=>'Added To Spreadsheet','color'=>'#d4edda','text'=>'#262626']);
                        }else{
                            return response()->json(['status'=>'upgrade','message'=>'<a class="upgrade_acc" href="subscription">Please Upgrade Account</a>','color'=>'#ea3f4f','text'=>'white']);
                        }
                    }
    
                }else{
                    return response()->json(['message'=>'Error Spreadsheet','color'=>'#ea3f4f','text'=>'white']);
                }
        }
        
        return response()->json(['status'=>'valid','message'=>'Added To Spreadsheet','color'=>'#d4edda','text'=>'#262626']);
	    
	}

	public function delete_acc_etsy(Request $req) {
		$id = $req->acc_id;
		EtsyAccount::where('id', '=', $id)->delete();
		return redirect('auto/etsy');
	}




































// 	public function getBillingCharge(Request $request) {
	    
//     		$etsy = EtsyAccount::where('etsy_shop_id', $request->etsy_id)->where('secret_key', '!=', null)->where('identifier', '!=', null)->first();

//     		$month = $request->get('month');
//     		$years = $request->get('year');
    		
//     		$current_page = $request->get('page');
            
//     		$transactions = $this->getAdsFee($month,$etsy,$years);
//     		$ledger = $this->getLedgerEntry($month,$etsy,$years);

//     		$response = collect($transactions)->merge($ledger);
//     		$response = collect($response)->sortBy('creation_tsz', SORT_DESC);
    		
//     		// $transactions = $transactions->sortBy("creation_tsz",SORT_DESC);
  
//     		$pagination = [
//     				'total_page' => 1,
//     				'total_transactions' => count($transactions)
//     		];
//     		$type = 'etsy';
//     		$pagination = (object)$pagination;
//     		return view('auto.widget.etsy_billing_table', compact('transactions', 'pagination', 'month', 'type'))->render();
	        
// 	}


// 	private function getAdsFee($month,$etsy,$years) {

// 		$year = $years;
// 		$startMonth = Carbon::parse($year.'-' . $month)->startOfMonth()->toDateString();
// 		$endMonth = Carbon::parse($year.'-' . $month)->endOfMonth()->toDateString();
// 		$stack = HandlerStack::create();

// 		$middleware = new Oauth1(
// 				[
// 						'token' => $etsy->identifier,
// 						'token_secret' => $etsy->secret_key,
// 						'consumer_key' => EtsyController::CONSUMER_KEY,
// 						'consumer_secret' => EtsyController::CONSUMER_SECRET
// 				]);
// 		$stack->push($middleware);
// 		$client = new Client([
// 				'base_uri' => "https://openapi.etsy.com/v2/",
// 				'handler' => $stack
// 		]);
// 		$shopId = $etsy->etsy_shop_id;

// 		// $url = "users/225432101/charges?min_created=.$startMonth.'&max_created='.$endMonth.'&limit=1000'";
// 		// $url = "users/225432101".'/charges?min_created='.$startMonth.'&max_created='.$endMonth.'&limit=1000';
// 		// $url = "users/225432101/payments";
        
// 		$url = "shops/".$etsy->etsy_shop_id."/payment_account/entries?min_created=".$startMonth."-01&max_created=".$endMonth."&limit=1000";
// 		// get sale fee
// // 		$url = "shops/".$etsy->etsy_shop_id.'/payment_account/entries/7750370542/payment';
// 		// $url = "shops/".$etsy->etsy_shop_id.'/payment_account/entries/7750370542/payment';
// 		// get sale fee from receipt id
// 		// $url = "shops/".$etsy->etsy_shop_id.'/receipts/1810458068/payments';
// 		// listing_id = 819245351
// 		// shipping_listing_id = 20965730865
// 		// $url = "shops/".$etsy->etsy_shop_id."/payment_account/entries/7392283911/payment";

// 		$res = $client->get($url, [
// 				'auth' => 'oauth'
// 		]);
	
// 		$response = json_decode($res->getBody()->getContents());
// // 		dd($response);
// 		$page = ceil($response->count / 100);

// 		$transactions = $response->results;

// 		$pagination = $response->pagination;
// 		$pagination->total_page = ceil($response->count / 100);
// 		$pagination->total_transactions = $response->count;
// 		$result = $transactions;
// 		for($i = 2; $i <= $page; $i ++) {
// 			$page = (int)$page;
// 			$url = "shops/" .$etsy->etsy_shop_id. '/payment_account/entries?min_created=' . $startMonth . '&max_created=' . $endMonth . '&limit=1000&page=' . $i;
// 			$res = $client->get($url, [
// 					'auth' => 'oauth'
// 			]);
// 			$response = json_decode($res->getBody()->getContents());
// 			$transactions = $response->results;
// 			$result = array_merge($result, $transactions);
// 		}
// 		$response = [];
// 		foreach($result as $key => $transaction) {
// 			if ($transaction->description == "offsite_ads_fee_refund" || $transaction->description == "RECOUP" || $transaction->description == "shipping_transaction_refund" || $transaction->description == "REFUND" || $transaction->description == "listing_refund" || $transaction->description == "PAYMENT" || $transaction->description == "DISBURSE2" || $transaction->description == "transaction_refund") {
// 				unset($result[$key]);
// 			} else {
// 				$temp = [
// 						'bill_charge_id' => $transaction->entry_id,
// 						'amount' => number_format(($transaction->amount * - 1) / 100, 2),
// 						'label' => ucwords(str_replace('_', ' ', $transaction->description)),
// 						'creation_tsz' => $transaction->create_date,
// 						'currency_code' => $transaction->currency
// 				];
// 				$response[] = (object)$temp;
// 			}
// 		}
// 		return $response;

// 	}

// 	private function setArrayBillingData($transactions) {

// 		foreach($transactions as $key => $transaction) {
// 			switch ($transaction->type) {
// 				case "shipping_labels" :
// 					$transactions[$key]->label = "Shipping Labels";
// 					break;
// 				case "renew_sold_auto" :
// 					unset($transactions[$key]);
// 					break;
// 				case "transaction_quantity" :
// 					$transactions[$key]->label = "Quantity Fee";
// 					break;
// 				case "listing" :
// 					$transactions[$key]->label = "Listing Fee";
// 					break;
// 				case "shipping_label_taxes" :
// 					$transactions[$key]->label = "Shipping Label Taxes";
// 					break;
// 			}
// 		}
// 		return $transaction;

// 	}


	
// 	public function getBillingPage(){
	    
// 	    $etsy_account = EtsyAccount::where('parent_email', auth()->user()->email)->orderBy('id', 'ASC')->where('secret_key', '!=', null)->where(
// 				'identifier', '!=', null)->get();
	    
// 	    return view('auto.etsy_billing_page',compact('etsy_account'))->with([
// 				'page' => 'etsy_auto'
// 		]);
	    
	    
// 	}
	
// 	public function addBillingExpense(Request $request){
	    
//         $expenses = (empty($request->expense)) ? [] :  $request->expense;
        
//         foreach($expenses as $expense) {
//             if( $expense['platform'] === "etsy") {
//                     $expense['account'] = "429 - General Expenses";
//                 if($expense['name'] === "Shipping Labels") {
//                     $expense['account'] = "425 - Freight & Courier";   
//                 }
//             }
//             $expenseModel = new Expense();
//             $expenseModel->user_id = Auth::id();
//             $expenseModel->spreadsheet_id = $expense['spreadsheet_id'];
//             $expenseModel->date = Carbon::parse($expense['date'])->format('Y-m-d');
//             $expenseModel->currency = $expense['currency'];
//             $expenseModel->name = $expense['name'];
//             $expenseModel->amount = $expense['other_fees'];
//             $expenseModel->account = $expense['account'];
//             $expenseModel->save();
//         }
    
//         return response()->json(['status'=>'valid','message'=>'Added To Spreadsheet','color'=>'#d4edda','text'=>'#262626']);

	    
// 	}

}