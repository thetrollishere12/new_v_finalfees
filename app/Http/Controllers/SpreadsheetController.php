<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Spreadsheet;
use App\Models\Sale;
use App\Models\Expense;
use DB;
use PDF;
use File;
use Carbon\Carbon;

class SpreadsheetController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {   
        $page = "spreadsheet";
        return view('spreadsheet.index')->with(['page'=>$page]);
    }

    /**
    * Query.
    */

    private function query($request){

        

        $sales = Sale::where('user_id', '=', Auth::id())
        ->whereBetween('date',[$request->start_date, $request->end_date])
        ->orderBy($request->sort,$request->sort_order)
        ->where('name','LIKE',"%{$request->name}%")
        ->when($request->spreadsheet_id != "summary", function($q){$q->where('spreadsheet_id', request('spreadsheet_id'));})
        ->when(user_is_subscribed() == false, function($q){$q->take(25);})
        ->paginate(25);

        $all_sales = Sale::where('user_id', '=', Auth::id())
        ->whereBetween('date',[$request->start_date, $request->end_date])
        ->orderBy($request->sort,$request->sort_order)
        ->where('name','LIKE',"%{$request->name}%")
        ->when($request->spreadsheet_id != "summary", function($q){$q->where('spreadsheet_id', request('spreadsheet_id'));})
        ->when(user_is_subscribed() == false, function($q){$q->take(25);})
        ->get();

        $expenses = Expense::where('user_id', '=', Auth::id())
        ->whereBetween('date',[$request->start_date, $request->end_date])
        ->orderBy($request->sort,$request->sort_order)
        ->where('name','LIKE',"%{$request->name}%")
        ->when($request->spreadsheet_id != "summary", function($q){$q->where('spreadsheet_id', request('spreadsheet_id'));})
        ->when(user_is_subscribed() == false, function($q){$q->take(25);})
        ->paginate(25);

        $all_expenses = Expense::where('user_id', '=', Auth::id())
        ->whereBetween('date',[$request->start_date, $request->end_date])
        ->orderBy($request->sort,$request->sort_order)
        ->where('name','LIKE',"%{$request->name}%")
        ->when($request->spreadsheet_id != "summary", function($q){$q->where('spreadsheet_id', request('spreadsheet_id'));})
        ->when(user_is_subscribed() == false, function($q){$q->take(25);})
        ->get();

        return array(
            'sales'=>$sales,
            'all_sales'=>$all_sales,
            'expense'=>$expenses,
            'all_expense'=>$all_expenses
        );
    }

    /**
    * Selecting Spreadsheet.
    */

    public function select(Request $request){

        if ($request->spreadsheet_id && $request->ajax()) { 

           $query = $this->query($request);

            return response()->json([
                "sales_number"=> $this->sales_numbers($query['all_sales']),
                "sales"=> $this->sales_grid($query['sales']),
                "expense_number"=>$this->expense_numbers($query['all_expense']),
                "expense"=> $this->expense_grid($query['expense'])
            ]);

        }       

    }

    public function sales_numbers($sales){

            return array(
                'status'=> 'valid',
                'spreadsheet_sales'=>array(
                    "sales"          =>$sales->count(),
                    "sold_price"     =>$sales->sum('sold_price'),
                    "shipping_charge"=>$sales->sum('shipping_charge'),
                    "item_cost"      =>$sales->sum('item_cost'),
                    "shipping_cost"  =>$sales->sum('shipping_cost'),
                    "fees"           =>$sales->sum('fees')+$sales->sum('other_fees'),
                    "p_fees"         =>$sales->sum('processing_fees'),
                    "tax"            =>$sales->sum('tax'),
                    "profit"         =>$sales->sum('profit')
                )
            );

    }

    public function sales_grid($sales){

        $json = json_decode(file_get_contents(storage_path()."/json/currency.json"), true); 

        if ($sales->count()>0) {
            return view('pg_widget.sales',['sales'=>$sales,'json'=>$json])->render();
        }else{
            return "<a href='company'><button id='emp' class='empty_btn'>Empty</button></a>";
        }
    }

    public function expense_numbers($sales){

        return array(
            'status'=> 'valid',
            'spreadsheet_ex'=>array(
            "expense"=>$sales->sum('amount')+$sales->sum('tax')
            )
        );

    }

    public function expense_grid($expenses){

        $json = json_decode(file_get_contents(storage_path()."/json/currency.json"), true); 

        if ($expenses->count()>0) {
            return view('pg_widget.expense',['expenses'=>$expenses,'json'=>$json])->render();
        }else{
            return "<a href='expense'><button id='emp' class='empty_btn'>Enter Expense</button></a>";
        }
    }

    /**
    * Paginating Spreadsheets.
    */

    public function paginate(Request $request){
        if($request->ajax()){

            $query = $this->query($request);
            return $this->sales_grid($query['sales']);

        }
            
    }

    public function paginate_ex(Request $request){
        if($request->ajax()){

            $query = $this->query($request);
            return $this->expense_grid($query['expense']);

        }
            
    }

    /**
    * Deleting a sale.
    */

    public function delete_sale(Request $request){

        $validator = \Validator::make($request->all(), [
            'action' => 'required',
            'item_id'=>'required'
        ]);

        if (!$validator->fails() && $request->ajax()) {
        $saved = Sale::where('id',$request->item_id)->where('spreadsheet_id', $request->spreadsheet_id)->delete();

            if ($saved) {

            $query = $this->query($request);
            
            return response()->json([
                "sales_number"=> $this->sales_numbers($query['all_sales']),
                "sales"=> $this->sales_grid($query['sales']),
                "expense_number"=>$this->expense_numbers($query['all_expense']),
                "expense"=> $this->expense_grid($query['expense'])
            ]);

            }

        }

    }

    public function delete_expense(Request $request){

        $validator = \Validator::make($request->all(), [
            'action' => 'required',
            'item_id'=>'required'
        ]);

        if (!$validator->fails() && $request->ajax()) {
        $saved = Expense::where('id',$request->item_id)->where('spreadsheet_id', $request->spreadsheet_id)->delete();

            if ($saved) {

            $query = $this->query($request);
            
            return response()->json([
                "sales_number"=> $this->sales_numbers($query['all_sales']),
                "sales"=> $this->sales_grid($query['sales']),
                "expense_number"=>$this->expense_numbers($query['all_expense']),
                "expense"=> $this->expense_grid($query['expense'])
            ]);

            }

        }

    }

    /**
    * Editing a sale.
    */

    public function edit_sale(Request $request){

        $validator = \Validator::make($request->all(), [
            'action' => 'required',
            'item_id'=>'required'
        ]);

        if (!$validator->fails() && $request->ajax()) {
            $saved = new Sale;
            $saved = Sale::find($request->item_id);
            // if ($saved->profit != $request->profit) {
            //     $profit = $request->profit;
            // }else{
            //     $profit = ($request->sold_price+$request->shipping_charge)-($request->item_cost+$request->shipping_cost+$request->fees+$request->other_fees+$request->processing_fees+$request->tax);
            // }
            $saved->spreadsheet_id = $request->spreadsheet_id;
            $saved->date = $request->date;
            $saved->currency = $request->currency;
            $saved->name = $request->itm_name;
            $saved->sold_price = $request->name;
            $saved->sold_price = $request->sold_price;
            $saved->item_cost = $request->item_cost;
            $saved->shipping_charge = $request->shipping_charge;
            $saved->shipping_cost = $request->shipping_cost;
            $saved->fees = $request->fees;
            $saved->other_fees = $request->other_fees;
            $saved->processing_fees = $request->processing_fees;
            $saved->tax = $request->tax;
            $saved->profit = ($request->sold_price+$request->shipping_charge)-($request->item_cost+$request->shipping_cost+$request->fees+$request->other_fees+$request->processing_fees+$request->tax);
            $saved->save();
            if ($saved) {

                $query = $this->query($request);

                return [
                    "sales" => $this->sales_numbers($query['sales']),
                    "expense" => $this->expense_numbers($query['expense'])
                ];

            }
        }
    }

    public function edit_expense(Request $request){

        $validator = \Validator::make($request->all(), [
            'action' => 'required',
            'item_id'=>'required'
        ]);

        if (!$validator->fails() && $request->ajax()) {
            $saved = new Expense;
            $saved = Expense::find($request->item_id);
            $saved->spreadsheet_id = $request->spreadsheet_id;
            $saved->date = $request->date;
            $saved->currency = $request->currency;
            $saved->name = $request->itm_name;
            $saved->amount = $request->amount;
            $saved->description = $request->description;
            $saved->account = $request->account;
            $saved->tax = $request->tax;
            $saved->save();

            if ($saved) {

                $query = $this->query($request);

                return [
                    "sales" => $this->sales_numbers($query['sales']),
                    "expense" => $this->expense_numbers($query['expense'])
                ];

            }
        }
    }


    /**
    * Getting Spreadsheet List.
    */

    public function sheet_list(Request $request){
        if ($request->ajax()) {
        
            $spreadsheet = Spreadsheet::where('user_id', '=', Auth::id())->when(user_is_subscribed() == false, function($q){$q->take(3);})->get();

            return response()->json([
                'list'=>$spreadsheet->toArray()
            ]);
        }
    }

    /**
    * Storing a List.
    */
                 
    public function store(Request $request){
        if ($request->ajax()) {

            $validator = \Validator::make($request->all(), [
                'action' => 'required',
                'spreadsheet_name'=>'required'
            ]);

            if (!$validator->fails()) {
                $saved = new Spreadsheet;
                $saved->user_id = Auth::id();
                $saved->spreadsheet_name = $request->spreadsheet_name;
    
                if (user_is_subscribed()) {
                    $saved->save();
                    return response()->json([
                         "status"=>$this->popup($saved),
                         "account"=>"premium"
                    ]);
                }else{
                    $count = Spreadsheet::where('user_id', '=', Auth::id())->count();
                    if ($count < 3) {
                        $saved->save();
                        return response()->json([
                             "status"=>$this->popup($saved),
                             "account"=>"regular"
                        ]);
                    }else{
                        return response()->json([
                             "status"=>"error",
                             "account"=>"upgrade"
                        ]);
                    }
                }
            }
        }
    }

    /**
    * Updating a List.
    */

    public function list_update(Request $request){
  
        $validator = \Validator::make($request->all(), [
            'action' => [
                'required',
                Rule::in(["Save"])
            ],
            'new_name'=>'required'
        ]);

        if (!$validator->fails() && $request->ajax()) {

            if ($request->action === "Save") {
                $saved = Spreadsheet::where('spreadsheet_id',$request->spreadsheet_id)
                ->where('user_id', Auth::id())
                ->update(['spreadsheet_name'=>$request->new_name]);
                return $this->popup($saved);
            }
        }
    }

    /**
    * Deleting a List.
    */

    public function list_delete(Request $request){

        $validator = \Validator::make($request->all(), [
            'action' => [
                'required',
                Rule::in(['Delete List',"Save"])
            ],
            'spreadsheet_name'=>'required'
        ]);

        if (!$validator->fails() && $request->ajax()) {

            if ($request->action === "Delete List") {
                $saved = Spreadsheet::where('spreadsheet_id',$request->spreadsheet_id)
                ->where('user_id', Auth::id())
                ->where('spreadsheet_name', $request->spreadsheet_name)->delete();

                Sale::where('spreadsheet_id',$request->spreadsheet_id)
                ->where('user_id', Auth::id())->delete(); 
                
                return $this->popup($saved);
            }  
        }
    }

    /**
    * Get Monthly Stats.
    */

    public function yearly(Request $request){
        if (user_is_subscribed()) {
            
            if ($request->sheet_sum == "summary") {
                if ($request->type == "total_fees") {
                    for ($i=1; $i <= 12; $i++) { 
                        $out[] = Sale::whereMonth('date', date($i))
                        ->whereYear('date','=',$request->year)
                        ->where('user_id', Auth::id())
                        ->sum(\DB::raw('fees+other_fees+processing_fees+tax'));
                    }
                }elseif($request->type == "expense"){
                    for ($i=1; $i <= 12; $i++) { 
                        $out[] = Expense::whereMonth('date', date($i))
                        ->whereYear('date','=',$request->year)
                        ->where('user_id', Auth::id())
                        ->sum(\DB::raw('amount+tax'));
                    }
                }else{
                    for ($i=1; $i <= 12; $i++) { 
                        $out[] = Sale::whereMonth('date', date($i))
                        ->whereYear('date','=',$request->year)
                        ->where('user_id', Auth::id())
                        ->sum($request->type);
                    }
                }
            }else{
            
                if ($request->type == "total_fees") {
                    for ($i=1; $i <= 12; $i++) { 
                        $out[] = Sale::whereMonth('date', date($i))
                        ->where('spreadsheet_id',$request->id)
                        ->whereYear('date','=',$request->year)
                        ->where('user_id', Auth::id())
                        ->sum(\DB::raw('fees+other_fees+processing_fees+tax'));
                    }
                }elseif($request->type == "expense"){
                    for ($i=1; $i <= 12; $i++) { 
                        $out[] = Expense::whereMonth('date', date($i))
                        ->whereYear('date','=',$request->year)
                        ->where('user_id', Auth::id())
                        ->sum(\DB::raw('amount+tax'));
                    }
                }else{
                    for ($i=1; $i <= 12; $i++) { 
                        $out[] = Sale::whereMonth('date', date($i))
                        ->where('spreadsheet_id',$request->id)
                        ->whereYear('date','=',$request->year)
                        ->where('user_id', Auth::id())
                        ->sum($request->type);
                    }
                }
            }
            return $out;
            
        }else{
            return null;
        }
    }

    public function popup($saved){
       if ($saved) {
           return $status = "valid";
       }else{
            return $status = "error";
       }
    }

    public function year_break(){
        $page = "yearbreak";
        return view('spreadsheet.yearly')->with(['page'=>$page]);
    }

    public function year_req(Request $request){
        
        if ($request->sheet_sum == "summary") {
            $sales = Sale::where('user_id', '=', Auth::id())->where('date','LIKE','%'.date("Y").'%')->get();
            $expenses = Expense::where('user_id', '=', Auth::id())->where('date','LIKE','%'.date("Y").'%')->get();
        }else{
            $sales = Sale::where('user_id', '=', Auth::id())->where('date','LIKE','%'.date("Y").'%')->where('spreadsheet_id',$request->spreadsheet_id)->get();
            $expenses = Expense::where('user_id', '=', Auth::id())->where('date','LIKE','%'.date("Y").'%')->where('spreadsheet_id',$request->spreadsheet_id)->get();
        }

        return [
            "sales" => $sales,
            "expense" => $expenses
        ];
    }

    public function download(Request $request){

            $sales = Sale::where('user_id', '=', Auth::id())
            ->whereBetween('date',[$request->start_date, $request->end_date])
            ->orderBy($request->sort,$request->sort_order)
            ->where('name','LIKE',"%{$request->name}%")
            ->when($request->spreadsheet_id != "summary", function($q){$q->where('spreadsheet_id', request('spreadsheet_id'));})
            ->when(user_is_subscribed() == false, function($q){$q->take(25);})
            ->get();

            $expenses = Expense::where('user_id', '=', Auth::id())
            ->whereBetween('date',[$request->start_date, $request->end_date])
            ->orderBy($request->sort,$request->sort_order)
            ->where('name','LIKE',"%{$request->name}%")
            ->when($request->spreadsheet_id != "summary", function($q){$q->where('spreadsheet_id', request('spreadsheet_id'));})
            ->when(user_is_subscribed() == false, function($q){$q->take(25);})
            ->get();

            $array = array(
                'sales'=>$sales,
                'expense'=>$expenses
            );

            $sku=str_replace([' ',':'],'-',Carbon::now()->addDays(1)->format('d-m H:i:s:u'));

            $codes = 'id='.Auth::id().uniqid().'e='.$sku;

            $fp = fopen(storage_path()."/download/".$codes.".csv", 'wb');

            $columns = array('Sales');
            fputcsv($fp,$columns);

            $columns = array('Date','Platform','Currency','Quantity','Name','Sold Price','Item Cost','Shipping Charge','Shipping Cost','Fees','Other Fees','Processing Fee','Tax','Profit');
            fputcsv($fp,$columns);

            foreach ($array['sales'] as $key => $value) {
                $columns = array($value->date,$value->platform,$value->currency,$value->quantity,$value->name,$value->sold_price,$value->item_cost,$value->shipping_charge,$value->shipping_cost,$value->fees,$value->other_fees,$value->processing_fees,$value->tax,$value->profit);
                fputcsv($fp,$columns);
            }

            $columns = [];
            fputcsv($fp,$columns);

            $columns = array('Expenses');
            fputcsv($fp,$columns);

            $columns = array('Date','Currency','Name','Description','Amount','Tax','Account');
            fputcsv($fp,$columns);

            foreach ($array['expense'] as $key => $value) {
                $columns = array($value->date,$value->currency,$value->name,$value->description,$value->amount,$value->tax,$value->account);
                fputcsv($fp,$columns);
            }


            fclose($fp);

            return response()->download(storage_path()."/download/".$codes.".csv");

    }




}


