@extends('layouts.platform')

@section('description')
Calculate your Amazon Paypal fees, processing fees, shipping amount and profits with our Amazon spreadsheet & fee calculator.
@endsection

@section('title')
Amazon Fee Calculator & Spreadsheet - Calculate Amazon Fees
@endsection


@section('content')
<div id="main-calculator">
	<div class="main-container">
    	<h1 style="background:{{ $json['color']  }}">AMAZON FEE CALCULATOR</h1>
    	<div class="p-6">
		<div>
			@include('pg_widget.name_date')
			<div class="input-container">
				<div class="label">
					<div class="tooltip">
						<img class="question_img" src="image/question.png" alt="question mark">
						<div class="right">
							<div class="text-content">
					            <p>Select the category type of the sold product(s)</p>
							</div>
							<i></i>
						</div>
					</div>
					<div>Product Type</div>
				</div>
				<div>
					<select name="product_type">
						@foreach($json["fees"]["fee_type"]["product_type"]["list"] as $select)
						<option value="{{ $select['amount'] }}">{{ $select['name'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
		
			@include('pg_widget.sold')
			@include('pg_widget.ship_charge')
			@include('pg_widget.ship_cost')
			@include('pg_widget.cost')
			@include('pg_widget.tax')
			@include('pg_widget.currency')
		</div>

		<div class="fee_profit-container">
			<div class="fee_profit-inner"><span><b class="pg-name">Amazon Fee: </b></span><span id="main-fees">0</span></div>
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
			<h2 style="background:{{ $json['color']  }}">ABOUT AMAZON FEES</h2>
			<p>Amazon is an online retail marketplace where they sell a large variety of goods, from house items to cloud services. Amazon offers two selling plans: Professional Selling Plan at $39.99 monthly subscription fee plus per-item selling fees vary by category and Individial plan at $0.99 per item sold plus per-item selling fees vary by category. If an item is sold under Amazon's media categories an additional flat $1.80 variable closing fee will be applied.</p>
		</div>
		@include('inc.graph')
	</div>
</div>	
@endsection
