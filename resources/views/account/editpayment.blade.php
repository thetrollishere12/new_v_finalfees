@extends('layouts.noapp')

@section('title')
  Edit Your Payment Method
@endsection()

@section('content')

<script src="https://js.stripe.com/v3/"></script>

<div id="payment-container">
  <p class="edit-title">Edit Payment Method</p>

  <form action="stripe-payment-subscription-update" method="POST" id="paymentFrm">
      @csrf

      <div class="card-info-b"><b>Card Information</b></div>
      <div id="paymentResponse"></div>
      <div class="credit-card-container">

          <div class="form-group card-number-container">
              <div id="card_number" class="field"></div>
              <div class="card-img-container">
                  <img src="{{asset('image/visa.svg')}}">
                  <img src="{{asset('image/mastercard.svg')}}">
                  <img src="{{asset('image/ae.svg')}}">
                  <div id="card-shift">
                      <img src="{{asset('image/discover.svg')}}">
                  </div>
              </div>
          </div>
          
          <div class="card-container-ex-cvc">
          

              <div class="form-group expiry-date-container">
                  <div id="card_expiry" class="field"></div>
              </div>

              <div class="form-group cvc-container">
                  <div id="card_cvc" class="field"></div>
              </div>


          </div>

      </div>

      <button type="submit" class="submit-payment-btn" id="payBtn">Update</button>

  </form>

</div>


<script type="text/javascript">


    function card_loop(){

      var addressArr = ['diners','jcb','unionpay','discover'];

    counter = 0;

    timer = setInterval(function(){
          codeAddress(addressArr[counter]);
          counter++
          if (counter === addressArr.length) {
                clearInterval(timer);
                card_loop();
          }
    },3000);

    }

    card_loop();

      function codeAddress(address) {
            $("#card-shift img").attr('src','{{ asset("image") }}/'+address+'.svg')
      }


var stripe = Stripe("{{ env('STRIPE_KEY') }}");

var elements = stripe.elements();

var style = {
    base: {
        fontWeight: 400,
        fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
        fontSize: '13px',
        lineHeight: '1.4',
        color: '#555',
        backgroundColor: '#fff',
        '::placeholder': {
            color: '#888',
        },
    },
    invalid: {
        color: '#eb1c26',
    }
};

var cardElement = elements.create('cardNumber', {
    style: style
});

cardElement.mount('#card_number');

var exp = elements.create('cardExpiry', {
    'style': style
});

exp.mount('#card_expiry');

var cvc = elements.create('cardCvc', {
    'style': style
});

cvc.mount('#card_cvc');

// Validate input of the card elements
var resultContainer = document.getElementById('paymentResponse');
cardElement.addEventListener('change', function(event) {
    if (event.error) {
        resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
    } else {
        resultContainer.innerHTML = '';
    }
});

// Get payment form element
var form = document.getElementById('paymentFrm');

// Create a token when the form is submitted.
form.addEventListener('submit', function(e) {
    e.preventDefault();
    createToken();
});

// Create single-use token to charge the user

function createToken() {


            stripe
              .createPaymentMethod({
                type: 'card',
                card: cardElement
            })
            .then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
                } else {
                    console.log(result);
                    // Send the token to your server.
                    stripeTokenHandler(result.paymentMethod.id);
                }
            });


}

// Callback to handle the response from stripe
function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'paymentMethod');
    hiddenInput.setAttribute('value', token);
    form.appendChild(hiddenInput);
    
    // Submit the form
    form.submit();
}

    $('.shopping-cart-container').delay(150).slideDown();

    $('main h2').delay(150).fadeIn();

$('.summary-tab').click(function(){
    $('.cart-product-container').slideToggle();
});

$('input[name=billing_checkbox]').click(function(){
    if($(this).is(':checked')){
        $('.billing-address-container').slideUp(200);
        $('.billing-address-container :input').removeAttr('required');
    }else{
        $('.billing-address-container').slideDown(200);
        $('.billing-address-container :input').not($('input[name=billing_address_line_2]')).attr('required','required');
    }
});

</script>

<style type="text/css">
    
@import url('https://fonts.googleapis.com/css?family=Open + Sans&display=swap');

* {
    font-family: "Open Sans", sans-serif;
    -ms-box-sizing: content-box;
    -moz-box-sizing: content-box;
    -webkit-box-sizing: content-box;
    box-sizing: content-box
}


    .card-number-container {
        position: relative
    }
    .card-img-container {
        display:flex;
        position: absolute;
        top: 10px;
        right: 10px
    }

    .card-img-container img{
        padding-right:2px;
    }

    #paypal-button-container div:nth-of-type(1) {
        min-width: 225px !important
    }
    .credit-card-container {
        box-shadow: 0 0 0 1px #e0e0e0;
        border-radius: 8px;
        margin: 10px 0
    }
    .card-number-container {
        padding: 10px;
        border-bottom: 1px solid rgba(26, 26, 26, .1)
    }
    .expiry-date-container {
        padding: 10px;
        border-right: 1px solid rgba(26, 26, 26, .1)
    }
    .cvc-container {
        padding: 10px
    }
    .card-container-ex-cvc {
        display: grid;
        grid-template-columns: 1fr 1fr
    }
    .submit-payment-btn {
        padding: 16px 0px;
        border: none;
        cursor: pointer;
        border-radius: 8px;
        font-weight: 700;
        width: 100%;
        font-size: 13px;
        outline: 0;
        background: #3490dc;
        color: white;
    }
    .payment-btn-ctn {
        display: flex
    }

</style>



@endsection