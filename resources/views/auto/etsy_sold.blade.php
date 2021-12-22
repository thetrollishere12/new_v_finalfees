@extends('layouts.noapp')
@section('others')
    <link href="{{asset('css/etsy_sold_item.css?213d')}}" rel="stylesheet" type="text/css" />
@endsection
@section('title')
Etsy Auto Sold Product Panel
@endsection
@section('content')

<!-- start : message by ward -->
<div class="msg animate slide-in-down"></div>
<!-- end message by ward -->
	<div class="auto-inner py-3">

		<div class="auto-list-container rounded">
			<div class="auto-list">
				<a href="{{ URL::to('auto/etsy') }}"><h2 class="summary-tab summary-ebay sheet">Etsy</h2></a>
		 		<a href="{{ URL::to('auto/ebay') }}"><h2>Ebay</h2></a> 
			</div>
		</div>

		<div class="auto-container">
			<div id="auto_title">

				<a href="{{ URL::to('auto/sold-item') }}"><div class="inline-block px-2" id="auto_sold">Sold Listing</div></a>
				
            </div>

            <h3 class="rounded text-left py-2 px-2 text-white" style="background: #3490dc;">Sales Transactions</h3>
            

            
			<div class="auto-grid">
       
                <div class="import-table">
                    <div class='total-entries'>Total entries : {{ $listing_count }}</div>
                </div>

                <table class="sold-table">
                    <thead>
                        <th class="all-input-th">

                        <input type="checkbox"  class="option-input radio" id="all-check" onclick="allcheck();">
               
                        </th>
                        <th>Transaction Id</th>
                        <th>Sale Date</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantities</th>
                        <th>Currency</th>
                        <th>Sold Price</th>
                        <th>Item Cost</th>
                        <th>Shipping Charge</th>
                        <th>Shipping Cost</th>
                        <th>Discount</th>
                        <th>Total Tax</th>
                        <th>Sub Total</th>
                        <th>Sale Fees</th>
                        <th>Profit</th>
                    </thead>

                    @if($listing_count > 0)

                        @foreach($listings as $listing)
                                                
                        <tr class="transaction" data-count="{{ $o }}">
                            <td>
                                <input type="checkbox" name="sold[]" class="fee-checkbox option-input radio" data-count="{{ $o }}">
                            </td>
                            <td>
                                <div class="table-val">
                                    {{ $listing['receipt']->receipt_id }}
                                </div>

                            </td>
                            <td>
                                <div class="table-val">
                                    {{ \Carbon\Carbon::parse($listing['receipt']->create_timestamp)->format('M d, Y') }}
                                </div>
                            </td>
                            
                            <td></td>
                            <td>
                                <div class="table-val">
                                  Etsy Sale {{ count($listing['receipt']->transactions) }} Item Sold ( | @foreach($listing['receipt']->transactions as $transaction){{$transaction->transaction_id }} | @endforeach)
                                </div>
                            </td>
                            <td><div class="table-val">{{ count($listing['receipt']->transactions) }}</div></td>
                            <td>
                                <div class="table-val">
                                    {{ $listing['receipt']->grandtotal->currency_code }}
                                </div>
                            </td>
                            
                            <td>
                                <div class="table-val">
                                    {{$listing['receipt']->total_price->amount/100}}
                                </div>
                            </td>
                            <td>
                                <div class="item_cost_div">0.00</div>
                            </td>

                            <td>
                                <div class="table-val">
                                    {{$listing['receipt']->total_shipping_cost->amount/100}}
                                </div>
                            </td>
                            
                            <td class="table-input">
                                <input type='number' class="shipping-cost shipping_cost_blk" value='0.00'>
                            </td>

                            
                            
                            <td>
                                <div class="table-val">
                                    {{$listing['receipt']->discount_amt->amount/100}}
                                </div>
                            </td>
                            
                             <td>
                                <div class="table-val">
                                    {{$listing['receipt']->total_tax_cost->amount/100}}
                                </div>
                            </td>
                            <td>
                                <div class="table-val">
                                    {{ ($listing['receipt']->total_price->amount+$listing['receipt']->total_shipping_cost->amount-$listing['receipt']->discount_amt->amount-$listing['receipt']->total_tax_cost->amount)/100 }}
                                </div>
                            </td>

                            <td>
                                <div class="table-val">
                                    {{ $listing['payments']->amount_fees->amount/100 }}
                                </div>
                            </td>

                            <td>
                                <div class="table-val profit_blk" data-profit="{{($listing['receipt']->total_price->amount+$listing['receipt']->total_shipping_cost->amount-$listing['receipt']->discount_amt->amount-$listing['receipt']->total_tax_cost->amount-$listing['payments']->amount_fees->amount)/100}}">
                                    {{ ($listing['receipt']->total_price->amount+$listing['receipt']->total_shipping_cost->amount-$listing['receipt']->discount_amt->amount-$listing['receipt']->total_tax_cost->amount-$listing['payments']->amount_fees->amount)/100 }}
                                </div>
                            </td>
                            
                        </tr>
                        


                        @foreach($listing['receipt']->transactions as $transaction)
                        <tr class="listing listing_blk" data-count="{{ $o }}">
                            <td></td>
                            <td>
                                <div class="table-val">
                                    {{$transaction->transaction_id}}
                                </div>
                            </td>
                            <td></td>
                            <td class="table-img">
                        
                                @if(isset($transaction->image))
                                <input class="w-4" type="image" src="{{ $transaction->image }}" > 
                                @else
                                <input class="w-4" type="image" src="{{url('image/empty.jpg')}}" > 
                                @endif

                            </td>
                            <td>
                                <div class="table-val">
                                    @if(strlen($transaction->title) > 90)
                                    {{ substr($transaction->title,0,90)}}...
                                    @else
                                    {{ substr($transaction->title,0,90)}}
                                    @endif
                
                                </div>
                            </td>
                            <td>
                                <div class="table-val">
                                    {{$transaction->quantity}}
                                </div>
                            </td>
                            <td>
                                <div class="table-val">
                                    {{ $listing['receipt']->grandtotal->currency_code }}
                                </div>
                            </td>
                            <td>
                                <div class="table-val">
                                    {{($transaction->price->amount/100)*$transaction->quantity}}
                                </div>
                            </td>
                            <td class="table-input">
                                <input type='number' class="item-cost" value='0.00'>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="table-val">{{ ((($listing['receipt']->discount_amt->amount/$listing['receipt']->total_price->amount)*$transaction->price->amount)/100)*$transaction->quantity }}</div>
                            </td>
                            <td><div class="table-val">{{ number_format(((($listing['receipt']->total_tax_cost->amount/$listing['receipt']->total_price->amount)*$transaction->price->amount)/100)*$transaction->quantity,2) }}</div></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        @endforeach
                           
                        @php $o++ @endphp

                        @endforeach
                        <tr><td colspan='20' id="no-data" class='text-center'><strong>No Sold</strong></td></tr>
                    @else
                       <tr><td colspan='20' class='empty-data text-center'><strong>No Sold</strong></td></tr>
                    @endif
                </table>
                    


                @if($pagination["total_page"] > 0 )
                <div class="paging">
                    <ul>
                    @if($pagination["total_page"] <= 3)
                        
                        @for($x = 1; $x <= $pagination["total_page"]; $x++)
                            <li onclick="selectPage({{$x}});" class="page-number page-deactive" @if($pagination['current_page'] == $x) id='page-active' @endif ><a >{{$x}}</a></li>
                        @endfor
                        
                    @else
                     
                        @if($pagination['current_page'] == 1)
                        
                        <li onclick="selectPage({{$pagination['current_page']}});" class="page-number" id='page-active'><a >{{$pagination['current_page']}}</a></li>
                        <li onclick="selectPage({{$pagination['current_page']+1}});" class='page-number page-deactive'><a >{{$pagination['current_page']+1}}</a></li>
                        <li onclick="selectPage({{$pagination['current_page']+2}});" class='page-number page-deactive'><a >{{$pagination['current_page']+2}}</a></li>
                        
                        @elseif($pagination['current_page'] == $pagination["total_page"])
                        
                        <li onclick="selectPage({{$pagination['current_page']-2}});" class='page-number page-deactive'><a >{{$pagination['current_page']-2}}</a></li>
                        <li onclick="selectPage({{$pagination['current_page']-1}});" class='page-number page-deactive'><a >{{$pagination['current_page']-1}}</a></li>
                        <li onclick="selectPage({{$pagination['current_page']}});" class="page-number" id='page-active'><a >{{$pagination['current_page']}}</a></li>
                        
                        @else
                        
                        <li onclick="selectPage({{$pagination['current_page']-1}});" class='page-number page-deactive'><a >{{$pagination['current_page']-1}}</a></li>
                        <li onclick="selectPage({{$pagination['current_page']}});" class="page-number" id='page-active'><a >{{$pagination['current_page']}}</a></li>
                        <li onclick="selectPage({{$pagination['current_page']+1}});" class='page-number page-deactive'><a >{{$pagination['current_page']+1}}</a></li>
                        
                        @endif
                     
                    @endif
                        
                    </ul>
                </div>
                @endif




            </div>

            <div class="flex">

                <div class="green text-sm self-center">Don't See Your Item</div>
                <div class="tooltip" id="tooltips">
                    <img class="question_img" src="{{url('image/question2.png')}}" alt="question mark">
                    <div class="right">
                        <div class="text-content">
                            <p>Some of your recently sold products may take 24 hours to appear since it takes time for Etsy to update your account.</p>
                        </div>
                        <i></i>
                    </div>
                </div>
                
            </div>


            @if(isset(Auth::user()->email_verified_at))
            <div id="list"></div>
            <div>
                <button class="create_sheet" data-toggle="modal" data-target="#add_page">Create Spreadsheet</button>
            </div>
            @endif
            <div class="alert alert-dismissible collapse newsheet-alert">
                <button type="button" id="newsheet_close_alert" class="close">&times;</button>
                <div class="alert-message newsheet-alert-message"></div>
            </div>

            @include('pg_widget.premium')
            <div class="alert popup_status">
                <button type="button" id="close_alert" class="close">&times;</button>
            </div>


        </div>

    </div>


<style type="text/css">

#active_account {
    padding: 4px 10px;
    border: solid 1px rgba(0, 0, 0, 0.25);
}

#active_account{
  padding:4px 10px;
  outline:none;
  margin:4px 0px;
}

.auto-inner a {
    color: inherit;
}
ul button {
    display: block;
}
.popup_status {
    position: fixed;
    top: 80%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;
    display: none;
    color: #fff;
}
.navbar.navbar-light .navbar-nav .nav-item .nav-link {
    color: #fff !important;
    -webkit-transition: 0.35s;
    transition: 0.35s;
}


</style>

<script src="{{asset('js/etsy_sold_item_ajax.js?34234')}}"></script>
<script src="{{asset('js/ajax.js?342434')}}"></script>
<script src="{{asset('js/etsy_sold_item.js?342553412')}}"></script>
@include('pg_widget.add_sheet')
@endsection
