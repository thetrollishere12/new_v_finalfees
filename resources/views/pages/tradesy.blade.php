@extends('layouts.platform')

@section('description')
Calculate & save your tradesy fees, profits, paypal fees and profit amount with our tradesy spreadsheet & fee calculator. Free Spreadsheet to record all of your sales.
@endsection

@section('title')
Tradesy Fee Calculator & Spreadsheet - Calculate Your Tradesy Fee
@endsection

@section('content')
<div id="main-calculator">
	<div class="main-container">
    	<h1 style="background:{{ $json['color']  }}">TRADESY FEE CALCULATOR</h1>
    	<div class="p-6">
    		@include('pg_widget.name_date')
			@include('pg_widget.sold')
			@include('pg_widget.cost')
			@include('pg_widget.tax')
			@include('pg_widget.currency')
			<div class="fee_profit-container">

				<div class="fee_profit-inner">
					<span><b class="pg-name">Tradesy Fee: </b></span><span id="main-fees">0</span>
				</div>
				<div class="fee_profit-inner"><span><b>Tax: </b></span><span id="main-tax"></span></div>

				<x-reset-button></x-reset-button>

				@include('pg_widget.profit')
				@include('pg_widget.add_to_sheet')
			</div>
			@include('inc.ad')
		</div>
	</div>
	<div class="details-container">
		<div class="about-container">
			<h2 style="background:{{ $json['color']  }}">ABOUT TRADESY FEES</h2>
			<p>Tradesy is an online marketplace for users to buy and sell women's luxury and designer contemporary fashion. Tradesy is simple and has only 1 fee that you have to worry about; for all sales under $50 Tradesy takes a flat commission of $7.50. For any sales over $50, Tradesy takes a commission of 19.80% of the total sale.</p>
		</div>
		@include('inc.graph')
	</div>
</div>

@endsection



