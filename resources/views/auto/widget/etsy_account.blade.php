<div class="account-table">
@foreach($etsy_account as $account)
  <div class="account-row">

		<div class="account-platform">Etsy</div>

		<div><img src="{{ $account->etsy_shop_icon }}"></div>

		<div class="account-email">{{ $account->etsy_email }}</div>

		<div class="account-btn">
        <form action="{{ url('auto/delete_acc_etsy') }}" method="POST">
            @csrf
            <input name="acc_id" type="hidden" value="{{$account->id}}"></input>
            <button type="submit" class="sales_account">Delete</button>
        </form>


		</div>

	</div>
@endforeach
	
	<div>

		<a href="https://www.etsy.com/oauth/connect?response_type=code&redirect_uri=https://www.finalfees.com&scope=transactions_r%20shops_r%20profile_r%20billing_r&client_id=4qa9aor3z104sk3b0bmsdcix&state={{ $state }}&code_challenge={{ $codeChallenge }}&code_challenge_method=S256" >
            <button class="add_account" class="btn btn-demo" >Connect Account Etsy</button>
        </a>

	</div>

</div>

