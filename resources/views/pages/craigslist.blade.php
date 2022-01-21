@extends('layouts.platform')

@section('description')
Calculate your Craigslist fees, shipping amount and profits with our Craigslist spreadsheet & fee calculator. Free Spreadsheet to record all of your sales.
@endsection()

@section('title')
Craigslist Fee Calculator & Spreadsheet - Calculate Craigslist Fee.
@endsection()

@section('content')

<div id="main-calculator">
	<div class="main-container">
    	<h1 style="background:{{ $json['color']  }}">CRAIGSLIST FEE CALCULATOR</h1>
		<div class="p-6">
			@include('pg_widget.name_date')
			@include('pg_widget.sold')
			@include('pg_widget.ship_charge')
			@include('pg_widget.ship_cost')
			@include('pg_widget.cost')
			@include('pg_widget.tax')
			@include('pg_widget.currency')

			<div class="fee_profit-container">
				<div class="fee_profit-inner"><span><b class="pg-name">Craigslist Fee: </b></span><span id="main-fees">0</span></div>
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
			<h2 style="background:{{ $json['color']  }}">ABOUT CRAIGSLIST FEES</h2>
			<p>Craigslist is an online marketplace which you can sell many items in minutes locally, Craigslist is free and does not collect any type of fee.</p>
		</div>
		@include('inc.graph')
	</div>
</div>

@endsection
