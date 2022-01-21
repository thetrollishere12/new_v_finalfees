@extends('layouts.noapp')
@section('others')

    <link rel="stylesheet" type="text/css" href="{{asset('css/auto.css?45431243423456446456')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/etsy_sold_item.css?4564641231234234236464566')}}" rel="stylesheet" type="text/css" />
@endsection
@section('title')
Etsy Auto Sold Product Panel
@endsection
@section('content')

    <style type="text/css">
        
    .auto-container{
        height: 70vh;
    }

    .dashboard h2{
        border-left: 6px solid transparent;
    }

    .dashboard-selected{
        color: #3490dc;
        border-left: 5px solid #3490dc !important;
    }

    .add_account{
        background: #f26223;
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

<!-- end message by ward -->
	<div class="auto-container bg-slate-100 flex flex-row">

		<div class="bg-white text-gray-400 dashboard">
            <h2 class="text-sm font-bold inline-block pr-24 pl-6 py-4 text-gray-800"><span class="icon-meter pr-3"></span>DASHBOARD</h2>
            <a href="{{ URL::to('auto/etsy') }}"><h2 class="dashboard-selected text-sm font-bold w-full pr-24 pl-6 py-4"><span class="icon-shop1 pr-3"></span>Etsy</h2></a>
            <a href="{{ URL::to('auto/ebay') }}"><h2 class="text-sm font-bold w-full pr-24 pl-6 py-4"><span class="icon-shop1 pr-3"></span>Ebay</h2></a> 

        </div>

		<div class="w-full rounded p-2 auto-grid">


            <h3 class="rounded-md text-left py-2 px-2 text-white main-bg-c shadow">Active Listing</h3>
            
			<div class="auto-grid">

                <div class="text-xs flex items-center justify-between">
                    <div class="py-1">
                        <a href="{{ URL::to('auto/sold-item') }}"><div class="rounded cursor-pointer inline-block px-4 py-2 bg-white shadow duration-100 hover:main-bg-c hover:text-white">Sold Listing</div></a>
                        <a href="{{ URL::to('auto/sold-item') }}"><div class="rounded cursor-pointer inline-block px-4 py-2 bg-white shadow duration-100 hover:main-bg-c hover:text-white">Active Listing</div></a>

                        <a href="{{ URL::to('auto/etsy/summary/20464863') }}"><div class="rounded cursor-pointer inline-block px-4 py-2 bg-white shadow duration-100 hover:main-bg-c hover:text-white">Summary</div></a>

                    </div>
                    <div>Total Listing - {{ $listing_count }}</div>

                </div>

                <table class="sold-table shadow">
                    <thead>
                        <th class="all-input-th @if($listing_count == 0) hidden @endif">

                        <input type="checkbox"  class="option-input radio" id="all-check">
               
                        </th>
                        <th class="bg-orange-400">Listing Id</th>
    
                        <th class="bg-orange-400">Image</th>
                        <th class="bg-orange-400">Status</th>
                        <th class="bg-orange-400">Name</th>
                        <th class="bg-orange-400">Quantities</th>
                        <th class="bg-green-500">Currency</th>
                        <th class="bg-blue-400">Price</th>
                        <th class="bg-green-500">Total Amount</th>

                    </thead>
                    <tbody>
                    @if($listing_count > 0)

                        @foreach($listings as $listing)
                                                
                        <tr class="transaction" data-count="{{ $o }}">

                            <td>
                                <input type="checkbox" name="sold[]" class="fee-checkbox option-input radio" data-count="{{ $o }}">
                            </td>
                            
                            <td>
                                <div class="table-val">
                                    {{ $listing->listing_id }}
                                </div>
                            </td>

                            <td class="table-img">
                        
                                @if(isset($listing->image))
                                <input class="w-4" type="image" src="{{ $listing->image }}" > 
                                @else
                                <input class="w-4" type="image" src="{{url('image/empty.jpg')}}" > 
                                @endif

                            </td>

                            <td>
                                <div class="table-val">
                                    {{ $listing->state }}
                                </div>
                            </td>

                            <td>
                                <div class="table-val">
                                    {{ $listing->title }}
                                </div>
                            </td>

                            <td>
                                <div class="table-val">
                                    {{ $listing->quantity }}
                                </div>
                            </td>

                            <td>
                                <div class="table-val">
                                    {{ $listing->price->currency_code }}
                                </div>
                            </td>

                            <td>
                                <div class="table-val">
                                    {{ $listing->price->amount/100 }}
                                </div>
                            </td>

                            <td>
                                <div class="table-val">
                                    {{ ($listing->price->amount/100)*$listing->quantity }}
                                </div>
                            </td>

                        </tr>
                           
                        @php $o++ @endphp

                        @endforeach
                        <tr><td colspan='20' id="no-data" class='text-center'><strong>No Sold</strong></td></tr>
                    @else
                       <tr><td colspan='20' class='empty-data text-center'><strong>No Sold</strong></td></tr>
                    @endif
                    </tbody>
                </table>
                    
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

            <x-add-to-spreadsheet></x-add-to-spreadsheet>

            <div class="alert alert-dismissible collapse newsheet-alert">
                <button type="button" id="newsheet_close_alert" class="close">&times;</button>
                <div class="alert-message newsheet-alert-message"></div>
            </div>

            @include('pg_widget.premium')

        </div>

    </div>

<script src="{{asset('js/etsy_sold_item_ajax.js?23434234')}}"></script>

<script src="{{asset('js/ajax.js?32342434')}}"></script>

<script src="{{asset('js/etsy_sold_item.js?342553234412')}}"></script>
@include('pg_widget.add_sheet')
@endsection
