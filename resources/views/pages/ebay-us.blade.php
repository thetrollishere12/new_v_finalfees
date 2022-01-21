@extends('layouts.platform')

@section('description')
Calculate & file your USA eBay fees, eBay store, eBay Paypal fees, profits and listing upgrade fees with our United States Ebay spreadsheet & fee calculator.
@endsection

@section('title')
Calculate USA eBay Paypal Fee Calculator & Spreadsheet
@endsection
		
@section('content')

<div id="main-calculator">
	<div class="main-container">

		<div class="country-container">
			<a href="ebay-us">
				<div>
					<img alt="Calculate & manage your online fees with our USA fee calculator & spreadsheet. Always up to date with the latest United States fees." class="country-icon" src="{{ asset('image/usa4.png?2') }}">
					<figcaption>USA EBAY</figcaption>
				</div>
			</a>
			<a href="ebay-ca">
				<div>
					<img alt="Calculate & manage your online CA fees with our Canada fee calculator & spreadsheet. Always up to date with the latest Canada fees." class="country-icon"  src="{{ asset('image/canada4.png?2') }}">
					<figcaption>CA EBAY</figcaption>
				</div>
			</a>
		</div>
		<div class="whole-calculator">
			<h1 style="background:{{ $json['color']  }}">USA EBAY PAYPAL FEE CALCULATOR</h1>
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
						            <p>Enter the amount Ebay charged for tax.</p>
								</div>
								<i></i>
							</div>
						</div>
						<div>Ebay Remitted Tax</div>
					</div>
					<div>
						<input type="number" oninput="nmb_length(this)" maxlength="20" name="remitted_tax">
					</div>
				</div>
				@include('pg_widget.tax')
				<div class="input-container">
					<div class="label">
						<div class="tooltip">
							<img class="question_img" src="image/question.png" alt="question mark">
							<div class="right">
								<div class="text-content">
						            <p>Select the currency you are using.</p>
								</div>
								<i></i>
							</div>
						</div>
						<div>Currency</div>
					</div>
					<div>
						<select name="currency" id="currency">
							<option value="$">USD</option>
						</select>
					</div>
				</div>
				<div class="input-container">
					<div class="label">
						<div class="tooltip">
							<img class="question_img" src="image/question.png" alt="question mark">
							<div class="right">
								<div class="text-content">
						        	<p>Deduction on ebay fee for outstanding seller levels and performance</p>
								</div>
								<i></i>
							</div>
						</div>
						<div class="input-container-txt">Top Rated Seller</div>
					</div>
					<div>
						<select name="t_r_seller">
							<option value="no">No</option>
							<option value="yes">Yes</option>
						</select>
					</div>
				</div>

				<div class="input-container">
					<div class="label">
						<div class="tooltip">
							<img class="question_img" src="image/question.png" alt="question mark">
							<div class="right">
								<div class="text-content">
									<p>Deduction on ebay fee for having an Ebay store(Basic, Premium, and Anchor Stores all charge the same rate).</p>
								</div>
								<i></i>
							</div>
						</div>
						<div class="input-container-txt">Ebay Store</div>
					</div>
					<div>
						<select name="ebay_store">
							<option value="no">No</option>
							<option value="yes">Yes</option>
						</select>
					</div>
				</div>

				<div id="category-slide">
					<div class="input-container">
						<div class="label">
							<div class="tooltip">
								<img class="question_img" src="image/question.png" alt="question mark">
								<div class="right">
									<div class="text-content">
										<p>Pick out what category is your Ebay store. If your category is not listed this means no additional deduction is given. Select Others if not listed.</p>
									</div>
									<i></i>
								</div>
							</div>
							<div class="input-container-txt">Category</div>
						</div>
						<div>
							<select name="category">
								@foreach($json["fees"]["fee_type"]["category_fees"]["list"] as $select)
								<option value="{{ $select['amount']/10 }}">{{ $select['name'] }} ({{ $select['amount'] }}%)</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="input-container">
					<div class="label">
						<div class="tooltip">
							<img class="question_img" src="image/question.png" alt="question mark">
							<div class="right">
								<div class="text-content">
						            <p>Enter the promotion percentage you are charged.</p>
								</div>
								<i></i>
							</div>
						</div>
						<div>Promotion Cost</div>
					</div>
					<div class="tax-container">
						<input type="number" id="" oninput="nmb_length(this)" maxlength="6" name="ad_cost">
						<div class="symbol">%</div>
					</div>
				</div>

				<div class="input-container half-padding">
					<div class="label">
						<div class="tooltip">
							<img class="question_img" src="image/question.png" alt="question mark">
							<div class="right">
								<div class="text-content">
									<p>Upgrades you have selected for your listing.</p>
								</div>
								<i></i>
							</div>
						</div>
						<div class="input-container-txt">Listing Upgrade</div>
					</div>
					<div>
						<select name="show">
							<option value="hide">Hide</option>
							<option value="show">Show</option>
						</select>
					</div>
				</div>
				<div class="list_up_ctn" style="display: none;">

					<label class="container">Free Listing
						<span class="upgrade-cost"></span>
						<input checked class="upgrade-box" type="checkbox" value="0">
						<span class="checkmark"></span>
					</label>

					@foreach($json["fees"]["fee_type"]["listing_upgrade_fees"]["list"] as $select)


					<label class="container">{{ $select['name'] }}
						<span class="upgrade-cost double">+ ${{ number_format($select['amount'],2) }}</span>
						<input class="upgrade-box" type="checkbox" value="{{ $select['amount'] }}">
						<span class="checkmark"></span>
					</label>

					@endforeach

					<label class="container">2 Categories
						<span class="upgrade-cost"> - Doubles all listing uptrade fees</span>
						<input class="upgrade-box" id="upgrade-double" type="checkbox" value="double">
						<span class="checkmark"></span>
					</label>

				</div>
				<div class="fee_profit-container">

					<div class="fee_profit-inner"><span><b class="pg-name">Ebay Fee: </b></span><span id="main-fees">0</span></div>
					<div class="fee_profit-inner"><span><b>Ebay Upgrade Fees: </b></span><span id="other-fees">0</span></div>
					@include('inc.paypal_slide')
					@include('pg_widget.profit')
					@include('pg_widget.add_to_sheet')
				</div>
				@include('inc.ad')
			</div>
		</div>
    	
	</div>
	<div class="details-container">
		<div class="about-container">
			<a href="{{ url('auto/ebay')}}"><h2 class="bbb">TRY OUR INSTANT EBAY FEE SYSTEM</h2></a>
			<p>You can now calculate <span class="bb">hundreds</span> of your sold listings in a <span class="bb">heartbeat</span> with all the <span class="bb">eBay & Paypal fees</span> without having to do a thing! All you have to do is connect with your eBay account and that's it.
			<br><a href="{{ url('auto/ebay')}}"><button>Click Here To Try It Now</button></a><a href="{{ url('tutorial-autosheet')}}"><button>Click Here For Tutorial</button></a>
			<br>
			</p>
		</div>
		<div class="about-container about-fees">
			<h2 style="background:{{ $json['color']  }}">ABOUT EBAY FEES</h2>
			<p>eBay is an online marketplace where users buy and sell products. eBay has 3 types of fees: Final Value Fee, Insertion Fee and Listing Upgrade Fee. A final value fee is charged when an item is sold where eBay takes 10% of the sold price and shipping charge combined plus <a href="{{url('/paypal')}}">Paypal fees</a>. If you run out of free listings, a $0.30 insertion fee is charged when you list an item. A listing upgrade fee is charged with any additional upgrades to your listing, such as extra categories or bolded titles.</p>
		</div>
		@include('inc.graph')
	</div>
</div>

@endsection