@if(isset(Auth::user()->email_verified_at))
<div id="list"></div>
<div>
    <button class="create_sheet" data-toggle="modal" data-target="#add_page">Create Spreadsheet</button>
</div>
@endif