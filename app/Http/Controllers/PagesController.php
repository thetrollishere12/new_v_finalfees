<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Spreadsheet;
use App\Models\Sale;
use App\Models\Expense;
use App\User;
use DB;
use File;
use Mail;
use App\Mail\Message;
use Session;
use ReCaptcha\ReCaptcha;
use Redirect;

class PagesController extends Controller
{

    public function index(){
        $page = "index";
        return view('pages.index')->with('page',$page);
    }

    public function depop(){
        $page = "depop";

        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);

        return view('pages.depop')->with(['page'=>$page,'json'=>$json[$page]]);
        
    }

    public function paypal(){
        $page = "paypal";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.paypal')->with(['page'=>$page,'json'=>$json[$page]]);
    
    }

    public function poshmark(){
        $page = "poshmark";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.poshmark')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function ebay(){
        $page = "ebay";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.ebay')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function ebay_ca(){
        $page = "ebay";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.ebay-ca')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function ebay_us(){
        $page = "ebay";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.ebay-us')->with(['page'=>$page,'json'=>$json[$page]]); 
    }

    public function ebay_au(){
        $page = "ebay";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.ebay-au')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function ebay_uk(){
        $page = "ebay";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.ebay-uk')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function amazon(){
        $page = "amazon";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.amazon')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function fiverr(){
        $page = "fiverr";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.fiverr')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function etsy(){
        $page = "etsy";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.etsy')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function grailed(){
        $page = "grailed";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.grailed')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function stockx(){
        $page = "stockx";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.stockx')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function goat(){
        $page = "goat";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.goat')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function bonanza(){
        $page = "bonanza";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.bonanza')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function tradesy(){
        $page = "tradesy";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.tradesy')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function stripe(){
        $page = "stripe";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.stripe')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function mercari(){
        $page = "mercari";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.mercari')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function offerup(){
        $page = "offerup";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.offerup')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function letgo(){
        $page = "letgo";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.letgo')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function craigslist(){
        $page = "craigslist";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.craigslist')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function facebook(){
        $page = "facebook";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.facebook')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function kijiji(){
        $page = "kijiji";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.kijiji')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function ecrater(){
        $page = "ecrater";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.ecrater')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function newegg(){
        $page = "newegg";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.newegg')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function chairish(){
        $page = "chairish";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.chairish')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function rubylane(){
        $page = "rubylane";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.rubylane')->with(['page'=>$page,'json'=>$json[$page]]);
    
    }

    public function ebid(){
        $page = "ebid";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.ebid')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function rakuten(){
        $page = "rakuten";
        $json = json_decode(file_get_contents(storage_path()."/json/platform.json"), true);
        return view('pages.rakuten')->with(['page'=>$page,'json'=>$json[$page]]);
    }

    public function refund(){
        $page = "refund";
        return view('pages.refund')->with(['page'=>$page]);
    }

    public function expense(){
        $page = "expense";
        return view('pages.expense')->with(['page'=>$page]);
    }

    public function error(){
        return view('pages.error');
    }

    public function company(){
        return view('pages.company')->with(['page'=>'index']);
    }

    public function tut_spreadsheet(){
        return view('tutorial.spreadsheet')->with(['page'=>'tut_spreadsheet']);
    }

    public function tut_auto(){
        return view('tutorial.automated')->with(['page'=>'tut_spreadsheet']);
    }

    public function tut_extension(){
        return view('tutorial.extension')->with(['page'=>'tut_spreadsheet']);
    }

    public function send_email(Request $request){

        $recaptcha = new ReCaptcha(env('GOOGLE_RECAPTCHA_SECRET_KEY'));
        $response = $recaptcha->verify($request->get('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

        if ($response->isSuccess()) {
        
            if (!empty($request->description)) {
                Mail::to("help@finalfees.com")->send(new message($request));
                Session::flash('message','Email Sent');
                return redirect('/');
            }else{
                return redirect('/');
            }

        }else{
            return Redirect::back()->withErrors(['Please Complete', 'The Message']);
        }

      
    }

    public function list(Request $request){
        if ($request->ajax()) {
            $spreadsheet = Spreadsheet::where('user_id', '=', Auth::id())->get();
            return view('pg_widget.list')->with(['spreadsheet'=>$spreadsheet]);
        }else{
            return "Error";
        }
    }

    public function list_expense(Request $request){
        if ($request->ajax()) {
            $spreadsheet = Spreadsheet::where('user_id', '=', Auth::id())->get();
            return view('pg_widget.list_expense')->with(['spreadsheet'=>$spreadsheet]);
        }else{
            return "Error";
        }
    }

    public function list_refund(Request $request){
        if ($request->ajax()) {
            $spreadsheet = Spreadsheet::where('user_id', '=', Auth::id())->get();
            return view('pg_widget.list_refund')->with(['spreadsheet'=>$spreadsheet]);
        }else{
            return "Error";
        }
    }

    public function auto(){
        $page = "auto";
        return view('auto.index')->with(['page'=>$page]);
    }

    public function store(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'spreadsheet_id' => 'required',
            'name'=>'required|max:20'
        ]);

        if (!$validator->fails()) {

            $spreadsheet_id = $request->spreadsheet_id;
            $count = Spreadsheet::where('user_id', '=', Auth::id())
            ->where('spreadsheet_id', '=', $spreadsheet_id)
            ->where('spreadsheet_name','=', $request->spreadsheet_name)
            ->count();
            $sales_count = Sale::where('user_id', '=', Auth::id())
            ->count();
            
            if ($count > 0) {
                $sale = new Sale;
                $sale->user_id = Auth::id();
                $sale->spreadsheet_id = $spreadsheet_id;
                $sale->date = $request->date;
                $sale->platform = $request->platform;
                $sale->name = $request->name;
                $sale->currency = $request->currency;
                $sale->quantity = 1;
                $sale->sold_price = $request->sold_price;
                $sale->item_cost = $request->item_cost;
                $sale->shipping_charge = $request->shipping_charge;
                $sale->shipping_cost = $request->shipping_cost;
                $sale->fees = $request->fees;
                $sale->other_fees = $request->other_fees;
                $sale->processing_fees = $request->processing_fees;
                $sale->tax = $request->tax;
                $sale->profit = $request->profit;
                if (user_is_subscribed()) {
                    $sale->save();
                    return response()->json(['status'=>'valid','message'=>'Added To Spreadsheet','color'=>'#d4edda','text'=>'#262626']);
                }else{
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
    }

    public function store_expense(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'spreadsheet_id' => 'required',
            'name'=>'required|max:20'
        ]);

        if (!$validator->fails()) {

            $spreadsheet_id = $request->spreadsheet_id;
            $count = Spreadsheet::where('user_id', '=', Auth::id())
            ->where('spreadsheet_id', '=', $spreadsheet_id)
            ->where('spreadsheet_name','=', $request->spreadsheet_name)
            ->count();
            $sales_count = Expense::where('user_id', '=', Auth::id())
            ->count();
            
            if ($count > 0) {
                $sale = new Expense;
                $sale->user_id = Auth::id();
                $sale->spreadsheet_id = $spreadsheet_id;
                $sale->date = $request->date;
                $sale->currency = $request->currency;
                $sale->name = $request->name;
                $sale->amount = $request->expense;
                $sale->description = $request->description;
                $sale->tax = $request->tax;
                $sale->account = $request->account;
                if (user_is_subscribed()) {
                    $sale->save();
                    return response()->json(['status'=>'valid','message'=>'Added To Spreadsheet','color'=>'#d4edda','text'=>'#262626']);
                }else{
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
    }
}