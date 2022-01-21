@if(isset(Auth::user()->email_verified_at))
	<div id="list"></div>
	<div class="my-1.5">
		<button class="create_sheet text-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Spreadsheet</button>

	</div>
@else
	<a href="{{url('/register?create_account')}}"><button class="add_sheet_btn my-1.5 text-sm">Add To Spreadsheet</button></a>
@endif

@if(isset($json["fees"]))
<button class="change_fees rounded text-sm text-white" type="button" data-bs-toggle="modal" data-bs-target="#RequestModalLabel">Request New Fees</button>
@endif

<a href="/tutorial-spreadsheet"><button class="how_btn my-1.5 text-sm">How Does This Work?</button></a>

<div class="alert alert-dismissible collapse">
    <button type="button" id="close_alert" class="close">&times;</button>
    <div class="alert-message"></div>
</div>
 
<div class="flex gap-1">
	<iframe src="https://www.facebook.com/plugins/share_button.php?href={{url()->current()}}&layout=button_count&size=small&width=77&height=20&appId" width="77" height="20" class="border-0 overflow-hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
	<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fofficialfinalfees%2F&width=59&layout=button&action=like&size=small&share=false&height=65&appId" width="59" height="20" class="border-0 overflow-hidden"  scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
	<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false"></a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>