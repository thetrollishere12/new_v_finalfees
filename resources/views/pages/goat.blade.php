@extends('layouts.platform')

@section('description')
Calculate your {{date("Y")}} Goat Paypal fees and shipping with our Goat spreadsheet & fee calculator. Free Spreadsheet to record all of your sales.
@endsection

@section('title')
Goat Paypal Fee Calculator & Spreadsheet - Calculate Goat Fees
@endsection

@section('content')

<div id="main-calculator">
	<div class="main-container">
    	<h1 style="background:{{ $json['color']  }}">GOAT PAYPAL FEE CALCULATOR</h1>
	    <div class="p-6">
	    	@include('pg_widget.name_date')
			<div class="input-container">
				<div class="label">
					<div class="tooltip">
						<img class="question_img" src="image/question.png" alt="question mark">
						<div class="right">
							<div class="text-content">
					            <p>Select on where you are located.</p>
							</div>
							<i></i>
						</div>
					</div>
					<div>Your Location</div>
				</div>
				<div>
					<select name="seller_location">
						@foreach($json["fees"]["fee_type"]["country_fees"]["list"] as $select)

						<option value="{{ $select['amount'] }}">{{ $select['name'] }}</option>

						@endforeach
					</select>
				</div>
			</div>

			@include('pg_widget.sold')
			@include('pg_widget.cost')
			@include('pg_widget.tax')
			@include('pg_widget.currency')
			<div class="hidden" id="category-slide">
				<div id="category-container">
					<div class="label">
						<div class="tooltip">
							<img class="question_img" src="image/question.png" alt="question mark">
							<div class="right">
								<div class="text-content">
						            <p>To withdraw cash from your Goat account into your Paypal or bank.</p>
								</div>
								<i></i>
							</div>
						</div>
						<div>Cash Out</div>
					</div>
					<div>
						<select name="cash_out" id="cash_out">
							<option value="0">No</option>
							<option value=".029">Yes</option>
						</select>
					</div>
				</div>
			</div>
			<div class="fee_profit-container">
				<div class="fee_profit-inner"><span><b>Cash Out Fee: </b></span><span id="other-fees">0</span></div>
				<div class="fee_profit-inner"><span><b class="pg-name">Goat Fee: </b></span><span id="main-fees">0</span></div>
				<div class="fee_profit-inner"><span><b>Tax: </b></span><span id="main-tax"></span></div>
				<x-reset-button></x-reset-button>
				<div class="fee_profit-inner">
					@include('pg_widget.profit')
					@include('pg_widget.add_to_sheet')
				</div>
			</div>
			@include('inc.ad')
		</div>
	</div>
	<div class="details-container">
		<div class="about-container">
			<h2 style="background:{{ $json['color']  }}">ABOUT GOAT FEES</h2>
			<p>Goat is a mobile sneaker marketplace where buyers can buy new or used pairs of sneakers from many sellers across the world. For each transaction that is made Goat collects a flat fee depending on the location which ranges from $5-$30 plus a 9.5% commision. A 2.9% cash out fee may apply if cashing out to your <a href="{{url('/paypal')}}">Paypal</a> Account or your bank. Sellers may only cash out if the total earnings are greater than $25</p>
		</div>
		@include('inc.graph')
	</div>
</div>
	
@endsection