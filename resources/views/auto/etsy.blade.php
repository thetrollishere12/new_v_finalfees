@extends('layouts.noapp')


@section('others')
<!--     <link rel="stylesheet" type="text/css" href="{{asset('css/auto.css?1233333333333333333333333333333333')}}"> -->
@endsection
@section('title')
	Etsy Auto Seller Account Panel
@endsection()

@section('content')

	<style type="text/css">
		
	.auto-container{
		height: 70vh;
	}

	.dashboard h2{
		border-left: 6px solid transparent;
	}

	.dashboard-selected{
		color: #3490dc;
		border-left: 5px solid #3490dc !important;
	}

	.add_account{
		background: #f26223;
	}

	</style>

	<div class="auto-container bg-slate-100 flex flex-row">


		<div class="bg-white text-gray-400 dashboard">
			<h2 class="text-sm font-bold inline-block pr-24 pl-6 py-4 text-gray-800"><span class="icon-meter pr-3"></span>DASHBOARD</h2>
			<a href="{{ URL::to('auto/etsy') }}"><h2 class="dashboard-selected text-sm font-bold w-full pr-24 pl-6 py-4"><span class="icon-shop1 pr-3"></span>Etsy</h2></a>
            <a href="{{ URL::to('auto/ebay') }}"><h2 class="text-sm font-bold w-full pr-24 pl-6 py-4"><span class="icon-shop1 pr-3"></span>Ebay</h2></a> 

		</div>


		<div class="w-full rounded p-2 auto-grid">

			<div>
				
				<div>
				@foreach($etsy_account as $account)

					<div class="bg-white grid grid-cols-3 mb-2 rounded text-xs py-2 px-4 items-center border">

						<div>{{ $account->etsy_email }}</div>

						<div class="text-center">
							{{ $account->etsy_shop_name }}
							<a href="{{ $account->etsy_shop_url }}"><img class="w-8 ml-2 rounded inline-block" src="{{ $account->etsy_shop_icon }}"></a>
						</div>

						

						<div class="text-right">
						
							<a href="{{ url('auto/etsy/sold/'.$account->etsy_shop_id) }}"><button class="main-bg-c p-1 px-2 rounded text-white">Sold Listings</button></a>

							<form class="inline-block" action="{{ url('auto/delete_acc_etsy') }}" method="POST">
					            @csrf
					            <input name="acc_id" type="hidden" value="{{$account->id}}">
					            <button type="submit" class="bg-red-500 p-1 px-2 rounded text-white">Delete</button>
					        </form>

						</div>

					</div>

				@endforeach
				</div>

				<div>
					<div>

						<a href="https://www.etsy.com/oauth/connect?response_type=code&redirect_uri=http://www.localhost/new_v_finalfees/public/auto/etsy/account-connect&scope=transactions_r%20listings_d%20listings_r%20listings_w%20shops_r%20email_r%20profile_r%20billing_r&client_id=4qa9aor3z104sk3b0bmsdcix&state={{ $state }}&code_challenge={{ $codeChallenge }}&code_challenge_method=S256" >
				            <button class="add_account py-2 px-6 rounded cursor-pointer text-white text-sm">Connect Etsy Account</button>
				        </a>

					</div>

				</div>

			</div>
            <div class="text-center text-xs text-gray-400 py-4">The term 'Etsy' is a trademark of Etsy, Inc.<br>This application uses the Etsy API but is not endorsed or certified by Etsy.</div>
		</div>
	</div>

    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul class="list-none">
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @elseif(\Session::has('error'))
    <div class="alert list-none" style="background:#c82333 !important;">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
    @endif

	@include('pg_widget.premium')

@endsection 
