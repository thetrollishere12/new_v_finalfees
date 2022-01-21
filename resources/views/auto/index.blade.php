@extends('layouts.app')


@section('description')
Automatically import your sales pre-calculated into our spreadsheet system.Calculates all of your profit,cost and fees for platforms such as Ebay,Etsy,Amazon & more.
@endsection

@section('title')
Automatic Sales Import Tracker System For Spreadsheet Ebay Etsy.
@endsection()

@section('content')
	<div class="auto-inner">
		
		<div class="auto-container">
			<a href="{{url('/spreadsheet')}}"><img alt="Spreadsheet System For Online Sales" class="auto-img m-auto py-12" src="{{url('image/auto.svg')}}"></a>
			<div class="text-center w-192 m-auto">
				<h2 class="font-bold pb-2 text-xl">A NEW WAY OF DOING THINGS</h2>
				<p>Still using <span class="blue">the traditional excel spreadsheets</span> to keep track of all your online sales? Let's be honest you know how much of a <span class="blue">pain it is to use it on the daily and things can get real messy</span>. Introducing our <span class="blue">new automated sales tracker</span> that <span class="blue">automatically</span> calculates all your fees and ready to be entered in our spreadsheet system <span class="blue">without you doing anything! All you have to do is add your seller's account, select what you want to import into our system and that's it!</span></p>
				<b><p>Currently Available For</p></b>
				<div class="btn-case">
					<a class="blue" href="{{url('/auto/ebay')}}"><button class="ebay-btn cursor-pointer rounded text-xs">Ebay</button></a>
					<a class="blue" href="{{url('/auto/etsy')}}"><button class="etsy-btn cursor-pointer rounded text-xs">Etsy</button></a>
				</div>
				<b><p>Coming Soon</p></b>
				<button class="amazon-btn mb-4 text-xs cursor-pointer rounded">Amazon</button>
			</div>
		</div>

	</div>

	@include('pg_widget.premium')

@endsection

<style type="text/css">
	
.ebay-btn {
    background: #86b817;
    border: solid 1px#86b817;
    transition: .2s;
    margin: 3px 0;
    color: #fff;
    padding: 10px 40px;
}
.ebay-btn:hover {
    background: #fff;
    color: #86b817;
    border: solid 1px #86b817;
}
.etsy-btn {
    background: #f26223;
    border: solid 1px #f26223;
    transition: .2s;
    margin: 3px 0;
    color: #fff;
    padding: 10px 40px;
}
.etsy-btn:hover {
    background: #fff;
    color: #f26223;
    border: solid 1px #f26223;
}
.amazon-btn {
    background: #f99a36;
    border: solid 1px #f99a36;
    transition: .2s;
    margin: 3px 0;
    color: #fff;
    padding: 10px 40px;
}
.amazon-btn:hover {
    background: #fff;
    color: #f99a36;
    border: solid 1px #f26223;
}
</style>