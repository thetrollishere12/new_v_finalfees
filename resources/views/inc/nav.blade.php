<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
	<div class="nav-shadow"></div>

        <button id="navbar-toggle" class="icon-menu1 text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
					<li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="showLeft">{{ __('Menu') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/message')}}" id="showLeft">{{ __('Contact Us') }}</a>
                    </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('expense') }}">{{ __('Enter Expense') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/spreadsheet')}}">
                                Spreadsheet
                            </a>
                            <a class="dropdown-item" href="{{url('/auto')}}">
                                Auto System
                            </a>
                            <a class="dropdown-item" href="{{url('expense')}}">
                                Enter Expense
                            </a>
                            <a class="dropdown-item" href="{{url('/home')}}">
                                Account Setting
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
 
</nav>
<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
	<div id="outer-nav">
		<div class="outer-arrow">
			<h2>Menu</h2>
			<div id="goback"><span class="icon-arrow-left"></span></div>
		</div>
		<a href="{{url('/amazon')}}" title="Amazon profit fee calculator."><h3>Amazon Fee Calculator</h3></a>
		<a href="{{url('/bonanza')}}" title="Bonanza profit fee calculator."><h3>Bonanza Fee Calculator</h3></a>
        <a href="{{url('/chairish')}}" title="Chairish profit fee calculator."><h3>Chairish Fee Calculator</h3></a>
        <a href="{{url('/craigslist')}}" title="Craigslist profit fee calculator."><h3>Craigslist Fee Calculator</h3></a>
		<a href="{{url('/depop')}}" title="Depop profit fee calculator."><h3>Depop Fee Calculator</h3></a>
		<a href="{{url('/ebay')}}" title="Ebay profit fee calculator."><h3>Ebay Fee Calculator</h3></a>
        <a href="{{url('/ecrater')}}" title="Ecrater profit fee calculator."><h3>Ecrater Fee Calculator</h3></a>
		<a href="{{url('/etsy')}}" title="Etsy profit fee calculator."><h3>Etsy Fee Calculator</h3></a>
        <a href="{{url('/facebook-marketplace')}}" title="Facebook profit fee calculator."><h3>Facebook Fee Calculator</h3></a>
		<a href="{{url('/fiverr')}}" title="Fiverr profit fee calculator."><h3>Fiverr Fee Calculator</h3></a>
		<a href="{{url('/goat')}}" title="Goat profit fee calculator."><h3>Goat Fee Calculator</h3></a>
		<a href="{{url('/grailed')}}" title="Grailed profit fee calculator."><h3>Grailed Fee Calculator</h3></a>
         <a href="{{url('/kijiji')}}" title="Kijiji profit fee calculator."><h3>Kijiji Fee Calculator</h3></a>
        <a href="{{url('/letgo')}}" title="Letgo profit fee calculator."><h3>Letgo Fee Calculator</h3></a>
		<a href="{{url('/mercari')}}" title="Mercari profit fee calculator."><h3>Mercari Fee Calculator</h3></a>
         <a href="{{url('/newegg')}}" title="Newegg profit fee calculator."><h3>Newegg Fee Calculator</h3></a>
        <a href="{{url('/offerup')}}" title="OfferUp profit fee calculator."><h3>OfferUp Fee Calculator</h3></a>
		<a href="{{url('/paypal')}}" title="Paypal profit fee calculator."><h3>Paypal Fee Calculator</h3></a>
		<a href="{{url('/poshmark')}}" title="Poshmark profit fee calculator."><h3>Poshmark Fee Calculator</h3></a>
         <a href="{{url('/rakuten')}}" title="Rakuten profit fee calculator."><h3>Rakuten Fee Calculator</h3></a>
          <a href="{{url('/rubylane')}}" title="Rubylane profit fee calculator."><h3>Rubylane Fee Calculator</h3></a>
		<a href="{{url('/stockx')}}" title="StockX profit fee calculator."><h3>StockX Fee Calculator</h3></a>
		<a href="{{url('/stripe')}}" title="Stripe profit fee calculator."><h3>Stripe Fee Calculator</h3></a>
		<a href="{{url('/tradesy')}}" title="Tradesy profit fee calculator."><h3>Tradesy Fee Calculator</h3></a>

        @auth
        <a href="{{url('/expense')}}" title="Enter expense fee."><h3>Enter Expense</h3></a>
        @endauth
	</div>
</div>


<style type="text/css">
    

.fade {
    transition: opacity 0.15s linear;
}
@media (prefers-reduced-motion: reduce) {
    .fade {
        transition: none;
    }
}
.fade:not(.show) {
    opacity: 0;
}
.collapse:not(.show) {
    display: none;
}
.collapsing {
    position: relative;
    height: 0;
    overflow: hidden;
    transition: height 0.35s ease;
}
@media (prefers-reduced-motion: reduce) {
    .collapsing {
        transition: none;
    }
}
.dropdown,
.dropleft,
.dropright,
.dropup {
    position: relative;
}
.dropdown-toggle {
    white-space: nowrap;
}
.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
}
.dropdown-toggle:empty::after {
    margin-left: 0;
}
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 10rem;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0.25rem;
}
.dropdown-menu-left {
    right: auto;
    left: 0;
}
.dropdown-menu-right {
    right: 0;
    left: auto;
}
@media (min-width: 576px) {
    .dropdown-menu-sm-left {
        right: auto;
        left: 0;
    }
    .dropdown-menu-sm-right {
        right: 0;
        left: auto;
    }
}
@media (min-width: 768px) {
    .dropdown-menu-md-left {
        right: auto;
        left: 0;
    }
    .dropdown-menu-md-right {
        right: 0;
        left: auto;
    }
}
@media (min-width: 992px) {
    .dropdown-menu-lg-left {
        right: auto;
        left: 0;
    }
    .dropdown-menu-lg-right {
        right: 0;
        left: auto;
    }
}
@media (min-width: 1200px) {
    .dropdown-menu-xl-left {
        right: auto;
        left: 0;
    }
    .dropdown-menu-xl-right {
        right: 0;
        left: auto;
    }
}
.dropup .dropdown-menu {
    top: auto;
    bottom: 100%;
    margin-top: 0;
    margin-bottom: 0.125rem;
}
.dropup .dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0;
    border-right: 0.3em solid transparent;
    border-bottom: 0.3em solid;
    border-left: 0.3em solid transparent;
}
.dropup .dropdown-toggle:empty::after {
    margin-left: 0;
}
.dropright .dropdown-menu {
    top: 0;
    right: auto;
    left: 100%;
    margin-top: 0;
    margin-left: 0.125rem;
}
.dropright .dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid transparent;
    border-right: 0;
    border-bottom: 0.3em solid transparent;
    border-left: 0.3em solid;
}
.dropright .dropdown-toggle:empty::after {
    margin-left: 0;
}
.dropright .dropdown-toggle::after {
    vertical-align: 0;
}
.dropleft .dropdown-menu {
    top: 0;
    right: 100%;
    left: auto;
    margin-top: 0;
    margin-right: 0.125rem;
}
.dropleft .dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
}
.dropleft .dropdown-toggle::after {
    display: none;
}
.dropleft .dropdown-toggle::before {
    display: inline-block;
    margin-right: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid transparent;
    border-right: 0.3em solid;
    border-bottom: 0.3em solid transparent;
}
.dropleft .dropdown-toggle:empty::after {
    margin-left: 0;
}
.dropleft .dropdown-toggle::before {
    vertical-align: 0;
}
.dropdown-menu[x-placement^="bottom"],
.dropdown-menu[x-placement^="left"],
.dropdown-menu[x-placement^="right"],
.dropdown-menu[x-placement^="top"] {
    right: auto;
    bottom: auto;
}
.dropdown-divider {
    height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid #e9ecef;
}
.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}
.dropdown-item:focus,
.dropdown-item:hover {
    color: #16181b;
    text-decoration: none;
    background-color: #f8f9fa;
}
.dropdown-item.active,
.dropdown-item:active {
    color: white;
    text-decoration: none;
    background-color: #3490dc;
}
.dropdown-item.disabled,
.dropdown-item:disabled {
    color: #6c757d;
    pointer-events: none;
    background-color: transparent;
}
.dropdown-menu.show {
    display: block;
}
.dropdown-header {
    display: block;
    padding: 0.5rem 1.5rem;
    margin-bottom: 0;
    color: #6c757d;
    white-space: nowrap;
}
.dropdown-item-text {
    display: block;
    padding: 0.25rem 1.5rem;
    color: #212529;
}
@media (prefers-reduced-motion: reduce) {
    .custom-control-label::before,
    .custom-file-label,
    .custom-select {
        transition: none;
    }
}
.nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.nav-link {
    display: block;
    padding: 0.5rem 1rem;
}
.nav-link:focus,
.nav-link:hover {
    text-decoration: none;
}
.nav-link.disabled {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
}
.nav-tabs {
    border-bottom: 1px solid #dee2e6;
}
.nav-tabs .nav-item {
    margin-bottom: -1px;
}
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
}
.nav-tabs .nav-link:focus,
.nav-tabs .nav-link:hover {
    border-color: #e9ecef #e9ecef #dee2e6;
}
.nav-tabs .nav-link.disabled {
    color: #6c757d;
    background-color: transparent;
    border-color: transparent;
}
.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
}
.nav-tabs .dropdown-menu {
    margin-top: -1px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.nav-pills .nav-link {
    border-radius: 0.25rem;
}
.nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
    color: #fff;
    background-color: #007bff;
}
.nav-fill .nav-item {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    text-align: center;
}
.nav-justified .nav-item {
    -ms-flex-preferred-size: 0;
    flex-basis: 0%;
    -ms-flex-positive: 1;
    flex-grow: 1;
    text-align: center;
}
.tab-content > .tab-pane {
    display: none;
}
.tab-content > .active {
    display: block;
}
.navbar {
    background: #262626;
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 10px 10px;
}
.navbar > .container,
.navbar > .container-fluid {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
.navbar-brand {
    display: inline-block;
    padding-top: 0.3125rem;
    padding-bottom: 0.3125rem;
    margin-right: 1rem;
    line-height: inherit;
    white-space: nowrap;
}
.navbar-brand:focus,
.navbar-brand:hover {
    text-decoration: none;
}
.navbar-nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.navbar-nav .nav-link {
    padding-right: 0;
    padding-left: 0;
}
.navbar-nav .dropdown-menu {
    position: static;
    float: none;
}
.navbar-text {
    display: inline-block;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}
.navbar-collapse {
    -ms-flex-preferred-size: 100%;
    flex-basis: 100%;
    -ms-flex-positive: 1;
    flex-grow: 1;
    -ms-flex-align: center;
    align-items: center;
}

@media (max-width: 575.98px) {
    .navbar-expand-sm > .container,
    .navbar-expand-sm > .container-fluid {
        padding-right: 0;
        padding-left: 0;
    }
}
@media (min-width: 576px) {
    .navbar-expand-sm {
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-pack: start;
        justify-content: flex-start;
    }
    .navbar-expand-sm .navbar-nav {
        -ms-flex-direction: row;
        flex-direction: row;
    }
    .navbar-expand-sm .navbar-nav .dropdown-menu {
        position: absolute;
    }
    .navbar-expand-sm .navbar-nav .nav-link {
        padding-right: 0.5rem;
        padding-left: 0.5rem;
    }
    .navbar-expand-sm > .container,
    .navbar-expand-sm > .container-fluid {
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
    }
    .navbar-expand-sm .navbar-collapse {
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-preferred-size: auto;
        flex-basis: auto;
    }

}
@media (max-width: 767.98px) {
    .navbar-expand-md > .container,
    .navbar-expand-md > .container-fluid {
        padding-right: 0;
        padding-left: 0;
    }
}
@media (min-width: 768px) {
    .navbar-expand-md {
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-pack: start;
        justify-content: flex-start;
    }
    .navbar-expand-md .navbar-nav {
        -ms-flex-direction: row;
        flex-direction: row;
    }
    .navbar-expand-md .navbar-nav .dropdown-menu {
        position: absolute;
    }
    .navbar-expand-md .navbar-nav .nav-link {
        padding-right: 0.5rem;
        padding-left: 0.5rem;
    }
    .navbar-expand-md > .container,
    .navbar-expand-md > .container-fluid {
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
    }
    .navbar-expand-md .navbar-collapse {
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-preferred-size: auto;
        flex-basis: auto;
    }

}
@media (max-width: 991.98px) {
    .navbar-expand-lg > .container,
    .navbar-expand-lg > .container-fluid {
        padding-right: 0;
        padding-left: 0;
    }
}
@media (min-width: 992px) {
    .navbar-expand-lg {
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-pack: start;
        justify-content: flex-start;
    }
    .navbar-expand-lg .navbar-nav {
        -ms-flex-direction: row;
        flex-direction: row;
    }
    .navbar-expand-lg .navbar-nav .dropdown-menu {
        position: absolute;
    }
    .navbar-expand-lg .navbar-nav .nav-link {
        padding-right: 0.5rem;
        padding-left: 0.5rem;
    }
    .navbar-expand-lg > .container,
    .navbar-expand-lg > .container-fluid {
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
    }
    .navbar-expand-lg .navbar-collapse {
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-preferred-size: auto;
        flex-basis: auto;
    }

}
@media (max-width: 1199.98px) {
    .navbar-expand-xl > .container,
    .navbar-expand-xl > .container-fluid {
        padding-right: 0;
        padding-left: 0;
    }
}
@media (min-width: 1200px) {
    .navbar-expand-xl {
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-pack: start;
        justify-content: flex-start;
    }
    .navbar-expand-xl .navbar-nav {
        -ms-flex-direction: row;
        flex-direction: row;
    }
    .navbar-expand-xl .navbar-nav .dropdown-menu {
        position: absolute;
    }
    .navbar-expand-xl .navbar-nav .nav-link {
        padding-right: 0.5rem;
        padding-left: 0.5rem;
    }
    .navbar-expand-xl > .container,
    .navbar-expand-xl > .container-fluid {
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
    }
    .navbar-expand-xl .navbar-collapse {
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-preferred-size: auto;
        flex-basis: auto;
    }

}
.navbar-expand {
    -ms-flex-flow: row nowrap;
    flex-flow: row nowrap;
    -ms-flex-pack: start;
    justify-content: flex-start;
}
.navbar-expand > .container,
.navbar-expand > .container-fluid {
    padding-right: 0;
    padding-left: 0;
}
.navbar-expand .navbar-nav {
    -ms-flex-direction: row;
    flex-direction: row;
}
.navbar-expand .navbar-nav .dropdown-menu {
    position: absolute;
}
.navbar-expand .navbar-nav .nav-link {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
}
.navbar-expand > .container,
.navbar-expand > .container-fluid {
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
}
.navbar-expand .navbar-collapse {
    display: -ms-flexbox !important;
    display: flex !important;
    -ms-flex-preferred-size: auto;
    flex-basis: auto;
}

.close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: 0.5;
}
.close:hover {
    color: #000;
    text-decoration: none;
}
.close:not(:disabled):not(.disabled):focus,
.close:not(:disabled):not(.disabled):hover {
    opacity: 0.75;
}
.alert {
    position: relative;
    padding: 0.5rem 1rem;
    margin-bottom: 0;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}
.alert-heading {
    color: inherit;
}
.alert-dismissible {
    padding-right: 4rem;
}
.alert-dismissible .close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.5rem 1rem;
    color: inherit;
}
button.close {
    padding: 0;
    background-color: transparent;
    border: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
a.close.disabled {
    pointer-events: none;
}
.modal-open {
    overflow: hidden;
}
.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
}
.modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    display: none;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
}
.modal-dialog {
    position: relative;
    width: auto;
    margin: 0.5rem;
    pointer-events: none;
}
.modal.fade .modal-dialog {
    transition: -webkit-transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
    transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
    -webkit-transform: translate(0, -50px);
    transform: translate(0, -50px);
}
@media (prefers-reduced-motion: reduce) {
    .modal.fade .modal-dialog {
        transition: none;
    }
}
.modal.show .modal-dialog {
    -webkit-transform: none;
    transform: none;
}
.modal-dialog-scrollable {
    display: -ms-flexbox;
    display: flex;
    max-height: calc(100% - 1rem);
}
.modal-dialog-scrollable .modal-content {
    max-height: calc(100vh - 1rem);
    overflow: hidden;
}
.modal-dialog-scrollable .modal-footer,
.modal-dialog-scrollable .modal-header {
    -ms-flex-negative: 0;
    flex-shrink: 0;
}
.modal-dialog-scrollable .modal-body {
    overflow-y: auto;
}
.modal-dialog-centered {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    min-height: calc(100% - 1rem);
}
.modal-dialog-centered::before {
    display: block;
    height: calc(100vh - 1rem);
    content: "";
}
.modal-dialog-centered.modal-dialog-scrollable {
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    height: 100%;
}
.modal-dialog-centered.modal-dialog-scrollable .modal-content {
    max-height: none;
}
.modal-dialog-centered.modal-dialog-scrollable::before {
    content: none;
}
.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
}
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #000;
}
.modal-backdrop.fade {
    opacity: 0;
}
.modal-backdrop.show {
    opacity: 0.5;
}
.modal-header {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: 0.3rem;
    border-top-right-radius: 0.3rem;
}
.modal-header .close {
    padding: 1rem 1rem;
    margin: -1rem -1rem -1rem auto;
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
}
.modal-body {
    position: relative;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1rem;
}
.modal-footer {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding: 1rem;
    border-top: 1px solid #dee2e6;
    border-bottom-right-radius: 0.3rem;
    border-bottom-left-radius: 0.3rem;
}
.modal-footer > :not(:first-child) {
    margin-left: 0.15rem;
}
.modal-footer > :not(:last-child) {
    margin-right: 0.15rem;
}
.modal-scrollbar-measure {
    position: absolute;
    top: -9999px;
    width: 50px;
    height: 50px;
    overflow: scroll;
}
@media (min-width: 576px) {
    .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
    }
    .modal-dialog-scrollable {
        max-height: calc(100% - 3.5rem);
    }
    .modal-dialog-scrollable .modal-content {
        max-height: calc(100vh - 3.5rem);
    }
    .modal-dialog-centered {
        min-height: calc(100% - 3.5rem);
    }
    .modal-dialog-centered::before {
        height: calc(100vh - 3.5rem);
    }
    .modal-sm {
        max-width: 300px;
    }
}
@media (min-width: 992px) {
    .modal-lg,
    .modal-xl {
        max-width: 800px;
    }
}
@media (min-width: 1200px) {
    .modal-xl {
        max-width: 1140px;
    }
}
.pagination {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-top: 3px;
    list-style: none;
    border-radius: 0.25rem;
}
.page-link {
    position: relative;
    display: block;
    padding: 0.25rem 0.5rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #3490dc;
    background-color: #fff;
    border: 1px solid #dee2e6;
}
.page-link:hover {
    color: #0056b3;
    text-decoration: none;
    background-color: #e9ecef;
    border-color: #dee2e6;
}
.page-link:focus {
    z-index: 2;
    outline: 0;
    box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.25);
}
.page-link:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.page-item:first-child .page-link {
    margin-left: 0;
    border-top-left-radius: 0.25rem;
    border-bottom-left-radius: 0.25rem;
}
.page-item:last-child .page-link {
    border-top-right-radius: 0.25rem;
    border-bottom-right-radius: 0.25rem;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #3490dc;
    border-color: #3490dc;
}
.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: auto;
    background-color: #fff;
    border-color: #dee2e6;
}

@media (min-width:0px) {

    #navbar-toggle{
        display:block;
    }
}
@media (min-width: 768px) {

    #navbar-toggle{
        display:none;
    }
}

</style>