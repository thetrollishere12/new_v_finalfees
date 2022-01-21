@extends('layouts.noapp')
@section('others')

    <link rel="stylesheet" type="text/css" href="{{asset('css/auto.css?4543124356446456')}}">

@endsection
@section('title')
Etsy Auto Sold Product Panel
@endsection
@section('content')

<!-- end message by ward -->
	<div class="auto-inner py-3">

		<div class="auto-list-container">

            <div class="auto-list">

                <a href="{{ URL::to('auto/etsy') }}"><h2 class="etsy-tab text-sm inline-block">Etsy</h2></a>

                <a href="{{ URL::to('auto/ebay') }}"><h2 class="ebay-tab text-sm inline-block">Ebay</h2></a> 

            </div>

        </div>

		<div class="auto-container">


            <h3 class="rounded-t-md text-left py-2 px-2 text-white" style="background: #3490dc;">Income Statement</h3>
            
			<div class="auto-grid">

                <div class="text-xs border border-b-0 px-1 flex items-center justify-between">

                    <div>
                        <a href="{{ URL::to('auto/sold-item') }}"><div class="rounded cursor-pointer inline-block px-4 py-2" id="auto_sold">Sold Listing</div></a>
                        <a href="{{ URL::to('auto/sold-item') }}"><div class="rounded cursor-pointer inline-block px-4 py-2" id="auto_sold">Active Listing</div></a>

                        <a href="{{ URL::to('auto/etsy/summary/20464863') }}"><div class="rounded cursor-pointer inline-block px-4 py-2" id="auto_sold">Summary</div></a>

                    </div>


                </div>

                <div class="w-full">
                    
                    <div><b>{{ $account->etsy_shop_name }}</b></div>
                    <div>Income Statement</div>
                    <div>September 30, 2020</div>


                    <table class="w-full">
                        

                        <tr>
                            <td></td>
                            <td></td>
                            <td>2020</td>
                        </tr>


                        <tr>
                            <td>Grand Total</td>
                            <td></td>
                            <td>{{ $ledger["grandtotal"]-$ledger["REFUND"] }}</td>
                        </tr>

                        <tr>
                            <td>Sales Tax</td>
                            <td></td>
                            <td>{{ $ledger["tax"] }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold">SALES</td>
                            <td></td>
                            <td>{{ $ledger["grandtotal"]-$ledger["tax"]-$ledger["REFUND"] }}</td>
                        </tr>

                        

                        <tr>
                            <td>Less:Sales Returns</td>
                            <td></td>
                            <td>{{ $ledger["REFUND"] }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold">NET SALES</td>
                            <td></td>
                            <td>{{ ($ledger["grandtotal"]-$ledger["tax"]) }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold">COST OF SALES</td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Delivery, freight and express</td>
                            <td></td>
                            <td>{{ $ledger["shipping_labels"] }}</td>
                        </tr>

                        <tr>
                            <td>Listing Fees</td>
                            <td></td>
                            <td>{{ $ledger["transaction_quantity"]+$ledger["renew_sold_auto"]+$ledger["renew_expired"]+$ledger["listing_refund"] }}</td>
                        </tr>

                        <tr>
                            <td>Sale Fees</td>
                            <td></td>
                            <td>{{ $ledger["sale_fee"] }}</td>
                        </tr>

                        <tr>
                            <td>Transaction Fees</td>
                            <td></td>
                            <td>{{ $ledger["transaction"]+$ledger["transaction_refund"] }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>GROSS PROFIT ({{  ((($ledger["shipping_labels"]+$ledger["transaction_quantity"]+$ledger["renew_sold_auto"]+$ledger["renew_expired"]+$ledger["listing_refund"]+$ledger["transaction"]+$ledger["transaction_refund"])+($ledger["PAYMENT"]+ $ledger["REFUND"])) / ($ledger["PAYMENT"]+ $ledger["REFUND"]))*100 }}%)</td>
                            <td></td>
                            <td>{{  $ledger["shipping_labels"]+$ledger["transaction_quantity"]+$ledger["renew_sold_auto"]+$ledger["renew_expired"]+$ledger["listing_refund"]+$ledger["transaction"]+$ledger["transaction_refund"]+$ledger["PAYMENT"]+ $ledger["REFUND"] }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="font-bold">EXPENSES</td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Marketing and ads expense</td>
                            <td></td>
                            <td>{{ $ledger["offsite_ads_fee"]+$ledger["offsite_ads_fee_refund"] }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>{{ $ledger["offsite_ads_fee"]+$ledger["offsite_ads_fee_refund"] }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold">NET INCOME/LOSS</td>
                            <td></td>
                            <td>{{ $ledger["shipping_labels"]+$ledger["transaction_quantity"]+$ledger["renew_sold_auto"]+$ledger["renew_expired"]+$ledger["listing_refund"]+$ledger["transaction"]+$ledger["transaction_refund"]+$ledger["PAYMENT"]+ $ledger["REFUND"]+$ledger["offsite_ads_fee"]+$ledger["offsite_ads_fee_refund"] }}</td>
                        </tr>

                    </table>


                </div>
                  
            </div>




        </div>

    </div>

<style>
table {

  border-collapse: collapse;

}

td:first-child {
  text-align: left;
  padding: 8px;
}

td:last-child {
  text-align:right;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
    
#auto_sold{
    background:#e6e6e6;
    margin: 5px 0px;
    transition: .3s;
}

#auto_sold:hover{
    color: white;
    background: #3490dc;
}

</style>


@include('pg_widget.add_sheet')
@endsection
