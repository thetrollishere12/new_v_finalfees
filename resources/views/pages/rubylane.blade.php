@extends('layouts.platform')

@section('description')
Calculate your Rubylane fees, shipping amount and profits with our Rubylane spreadsheet & fee calculator. Free spreadsheet to record all of your sales.
@endsection()

@section('title')
Rubylane Fee Calculator & Spreadsheet - Calculate Rubylane Fee.
@endsection()

@section('content')

<div id="main-calculator">
	<div class="main-container">
    	<h1 style="background:{{ $json['color']  }}">RUBYLANE FEE CALCULATOR</h1>
		<div class="p-6">
			@include('pg_widget.name_date')
			@include('pg_widget.sold')
			@include('pg_widget.ship_charge')
			@include('pg_widget.ship_cost')
			@include('pg_widget.cost')
			@include('pg_widget.tax')
			@include('pg_widget.currency')

			<div class="fee_profit-container">
				<div class="fee_profit-inner"><span><b class="pg-name">Rubylane Fee: </b></span><span id="main-fees">0</span></div>
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
			<h2 style="background:{{ $json['color']  }}">ABOUT RUBYLANE FEES</h2>
			<p>Rubylane is an online marketplace where sellers sell antiques, vintage collectibles, fine art and jewelry. For each sale made a 6.7% commission is applied to the sold price. A maintenance fee will also apply depending on how many items you have listed starting at $54 per month.</p>
		</div>
		@include('inc.graph')
	</div>
</div>

@endsection
