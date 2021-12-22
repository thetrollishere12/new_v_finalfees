@extends('layouts.noapp')


@section('others')
    <link rel="stylesheet" type="text/css" href="{{asset('css/ebay_auto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/auto_account.css')}}">
@endsection
@section('title')
	Etsy Auto Seller Account Panel
@endsection()

@section('content')
<!-- <div class="load_ctn"><img class="preloader" src="{{ asset('image/preloader.gif') }}"></div> -->
	<div class="auto-inner">

		<div class="auto-list-container">

			<div class="auto-list">

				<a href="{{ URL::to('auto/etsy') }}"><h2 class="summary-tab summary-ebay sheet">Etsy</h2></a>

		 		<a href="{{ URL::to('auto/ebay') }}"><h2>Ebay</h2></a> 

			</div>

		</div>

		<div class="auto-container">

<!-- 			<div class="load_ctn"><img class="preloader" src="image/preloader.gif"></div> -->

			<div class="auto-grid">
				
				<div class="account-table">
				@foreach($etsy_account as $account)
				<div class="account-row">

					<div class="account-platform">{{ $account->etsy_shop_name }}</div>

					<div><a href="{{ $account->etsy_shop_url }}"><img class="w-8 rounded inline-block" src="{{ $account->etsy_shop_icon }}"></a></div>

					<div class="account-email">{{ $account->etsy_email }}</div>

					<div class="account-btn">
					
						<a href="{{ url('auto/etsy/sold/'.$account->etsy_shop_id) }}"><button class="inline-block view_sold_listing_btn">Sold Listings</button></a>

						<form class="inline-block" action="{{ url('auto/delete_acc_etsy') }}" method="POST">
				            @csrf
				            <input name="acc_id" type="hidden" value="{{$account->id}}">
				            <button type="submit" class="sales_account">Delete</button>
				        </form>

					</div>

				</div>

				@endforeach
				</div>

				<div>
					<div>

						<a href="https://www.etsy.com/oauth/connect?response_type=code&redirect_uri=http://www.localhost/new_v_finalfees/public/auto/etsy/account-connect&scope=transactions_r%20shops_r%20email_r%20profile_r%20billing_r&client_id=4qa9aor3z104sk3b0bmsdcix&state={{ $state }}&code_challenge={{ $codeChallenge }}&code_challenge_method=S256" >
				            <button class="add_account" class="btn btn-demo" >Connect Etsy Account</button>
				        </a>

					</div>

				</div>

			</div>
            <div class="endorsed-line">The term 'Etsy' is a trademark of Etsy, Inc.<br>This application uses the Etsy API but is not endorsed or certified by Etsy.</div>
		</div>
	</div>

    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @elseif(\Session::has('error'))
    <div class="alert" style="background:#c82333 !important;">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
    @endif

	@include('pg_widget.premium')



	<!--<div class="alert popup_status">-->

	<!--	<button type="button" id="close_alert" class="close">&times;</button>-->
 <!--       <div class="alert-message"></div>-->
	<!--</div>-->


<style>
    .endorsed-line{
        color:#262626;
        text-align:center;
        font-size:12px;
        padding:9px 0px;
    }
    
    .alert ul{
        list-style:none;
    }
</style>
<!-- <script type="text/javascript">

			$('#auto_account').addClass('select-blue');
			
			$.ajax({
	            url: window.origin+"/auto/etsy/account",
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            method: "GET",
	            success: function(result) {
                    $(".auto-grid").empty().append(result);
                    $('#tooltips').show();
	                $(".load_ctn").fadeOut();
	            },
	            error: function(request, status, error) {
	                $(".auto-grid").empty().append("Error")
	            }
	        });
	        
</script>
 -->
@endsection 