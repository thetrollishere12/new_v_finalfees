@extends('layouts.noapp')


@section('others')
	<link rel="stylesheet" type="text/css" href="{{url('css/auto_account.css?5')}}">
@endsection
@section('title')

	Ebay Auto Seller Account Panel

@endsection()

@section('content')

	<div class="auto-inner">

		<div class="auto-list-container">

			<div class="auto-list">

				<a href="{{ URL::to('auto/ebay') }}"><h2 class="summary-tab summary-ebay sheet">Ebay</h2></a>

		 		<h2><a href="{{ URL::to('auto/etsy') }}">Etsy</a></h2> 

				<ul class="sheet-ul"></ul>

			</div>

		</div>

		<div class="auto-container">

<!-- 			<div class="load_ctn"><img class="preloader" src="image/preloader.gif"></div> -->

			<div id="auto_title">

				<a href="{{ URL::to('auto/ebay') }}"><div id="auto_account">Account</div></a>

<!-- 				<div>Auto</div> -->

				<!-- <div id="auto_import">Import Sales</div> -->

				<a href="{{ URL::to('auto/sold-item') }}"><div id="auto_sold">Sold Listing</div></a>

<!-- 				<div>Queue</div> -->

<!-- 				<div id="auto_active">Active Listing</div>  -->

			</div>

				<div class="account-table">
					<!-- Example -->

					
					<!--  -->

					<div>

						<a href="https://auth.sandbox.ebay.com/oauth2/authorize?client_id={{ env('EBAY_CLENT_APP_ID') }}&response_type=code&redirect_uri={{ env('EBAY_REDIRECT_URI') }}&scope=https://api.ebay.com/oauth/api_scope https://api.ebay.com/oauth/api_scope/buy.order.readonly https://api.ebay.com/oauth/api_scope/buy.guest.order https://api.ebay.com/oauth/api_scope/sell.marketing.readonly https://api.ebay.com/oauth/api_scope/sell.marketing https://api.ebay.com/oauth/api_scope/sell.inventory.readonly https://api.ebay.com/oauth/api_scope/sell.inventory https://api.ebay.com/oauth/api_scope/sell.account.readonly https://api.ebay.com/oauth/api_scope/sell.account https://api.ebay.com/oauth/api_scope/sell.fulfillment.readonly https://api.ebay.com/oauth/api_scope/sell.fulfillment https://api.ebay.com/oauth/api_scope/sell.analytics.readonly https://api.ebay.com/oauth/api_scope/sell.marketplace.insights.readonly https://api.ebay.com/oauth/api_scope/commerce.catalog.readonly https://api.ebay.com/oauth/api_scope/buy.shopping.cart https://api.ebay.com/oauth/api_scope/buy.offer.auction https://api.ebay.com/oauth/api_scope/commerce.identity.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.email.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.phone.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.address.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.name.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.status.readonly https://api.ebay.com/oauth/api_scope/sell.finances https://api.ebay.com/oauth/api_scope/sell.item.draft https://api.ebay.com/oauth/api_scope/sell.payment.dispute https://api.ebay.com/oauth/api_scope/sell.item https://api.ebay.com/oauth/api_scope/sell.reputation https://api.ebay.com/oauth/api_scope/sell.reputation.readonly https://api.ebay.com/oauth/api_scope/commerce.notification.subscription https://api.ebay.com/oauth/api_scope/commerce.notification.subscription.readonly"><button class="add_account" class="btn btn-demo" >Connect Account</button></a>

					</div>

				</div>

		</div>

	</div>

	@include('pg_widget.premium')

@endsection