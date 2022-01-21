@extends('layouts.platform')

@section('description')
Calculate your eCrater fees, shipping amount and profits with our eCrater spreadsheet & fee calculator. Free spreadsheet to record all of your online sales.
@endsection()

@section('title')
eCrater Fee Calculator & Spreadsheet - Calculate eCrater Sale Fee
@endsection()

@section('content')

<div id="main-calculator">
	<div class="main-container">
    	<h1 style="background:{{ $json['color']  }}">ECRATER FEE CALCULATOR</h1>
		<div class="p-6">
			@include('pg_widget.name_date')
			@include('pg_widget.sold')
			@include('pg_widget.ship_charge')
			@include('pg_widget.ship_cost')
			@include('pg_widget.cost')
			@include('pg_widget.tax')
			@include('pg_widget.currency')

			<div class="fee_profit-container">
				<div class="fee_profit-inner"><span><b class="pg-name">eCrater Fee: </b></span><span id="main-fees">0</span></div>
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
			<h2 style="background:{{ $json['color']  }}">ABOUT ECRATER FEES</h2>
			<p>eCrater is an online marketplace where it allows sellers to make their own policies. For eCrater a 2.9% fee is issued on the sale price if a sale is made from the main marketplace. If the sale is made directly from your own store no fees would be applied.</p>
		</div>
		@include('inc.graph')
	</div>
</div>

@endsection
