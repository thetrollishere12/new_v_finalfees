@extends('layouts.platform')

@section('description')
Calculate your Rakuten fees, shipping amount and profits with our Rakuten spreadsheet & fee calculator. Free spreadsheet to record all of your sales.
@endsection()

@section('title')
Rakuten Fee Calculator & Spreadsheet - Calculate Rakuten Fee.
@endsection()

@section('content')

<div id="main-calculator">
	<div class="main-container">
    	<h1 style="background:{{ $json['color']  }}">RAKUTEN FEE CALCULATOR</h1>
		<div class="p-6">
			@include('pg_widget.name_date')
			@include('pg_widget.sold')
			@include('pg_widget.ship_charge')
			@include('pg_widget.ship_cost')
			@include('pg_widget.cost')

			<div class="input-container">
				<div class="label">
					<div class="tooltip">
						<img class="question_img" src="image/question.png" alt="question mark">
						<div class="right">
							<div class="text-content">
					        	<p>Select what category your sold product was under.</p>
							</div>
							<i></i>
						</div>
					</div>
					<div class="input-container-txt">Product Category</div>
				</div>
				<div>
					<select name="category">
						@foreach($json["fees"]["fee_type"]["category_fees"]["list"] as $select)
						<option value="{{ $select['amount'] }}">{{ $select['name'] }} ({{ $select['amount'] }}%)</option>
						@endforeach
					</select>
				</div>
			</div>

			@include('pg_widget.tax')
			@include('pg_widget.currency')

			<div class="fee_profit-container">
				<div class="fee_profit-inner"><span><b class="pg-name">Rakuten Fee: </b></span><span id="main-fees">0</span></div>
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
			<h2 style="background:{{ $json['color']  }}">ABOUT RAKUTEN FEES</h2>
			<p>Rakuten is an online marketplace where sellers sell a large variety of goods, from house items to cloud services. For each sale made a 99 cent per item sold fee is applied including a category fee depending on what the product is ranging from 8% - 15%. A $39 monthly fee is also applied.</p>
		</div>
		@include('inc.graph')
	</div>
</div>

@endsection
