<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');

Route::get('/index', 'PagesController@index');

Route::get('/amazon','PagesController@amazon');

Route::get('/bonanza','PagesController@bonanza');

Route::get('/depop','PagesController@depop');

Route::get('/ebay','PagesController@ebay');

// Route::get('/ebay-au','PagesController@ebay_au');

// Route::get('/ebay-uk','PagesController@ebay_uk');

Route::get('/ebay-ca','PagesController@ebay_ca');

Route::get('/ebay-us','PagesController@ebay_us');

Route::get('/etsy','PagesController@etsy');

Route::get('/fiverr','PagesController@fiverr');

Route::get('/goat','PagesController@goat');

Route::get('/grailed','PagesController@grailed');

Route::get('/mercari','PagesController@mercari');

Route::get('/paypal','PagesController@paypal');

Route::get('/poshmark','PagesController@poshmark');

Route::get('/stockx','PagesController@stockx');

Route::get('/stripe','PagesController@stripe');

Route::get('/tradesy','PagesController@tradesy');

Route::get('/offerup','PagesController@offerup');

Route::get('/letgo','PagesController@letgo');

Route::get('/craigslist','PagesController@craigslist');

Route::get('/company','PagesController@company');

Route::get('/facebook-marketplace','PagesController@facebook');

Route::get('/kijiji','PagesController@kijiji');

Route::get('/ecrater','PagesController@ecrater');

Route::get('/newegg','PagesController@newegg');

Route::get('/chairish','PagesController@chairish');

Route::get('/rubylane','PagesController@rubylane');

Route::get('/ebid','PagesController@ebid');

Route::get('/rakuten','PagesController@rakuten');

Route::get('/auto','PagesController@auto');

Route::get('/error','PagesController@error');

// Tutorial Stop Removing This.
Route::get('/tutorial-spreadsheet','PagesController@tut_spreadsheet');

Route::get('/tutorial-autosheet','PagesController@tut_auto');

Route::get('/tutorial-extension','PagesController@tut_extension');

Route::get('/message',function(){
    return view('account.message')->with('page','message');
});

Route::post('/send_msg','PagesController@send_email');

// Google
Route::get('/google-login-auth','GoogleAuth@redirectToProviderAuth');

Route::get('/google-login', 'GoogleAuth@redirectToProvider');
Route::get('/callback', 'GoogleAuth@handleProviderCallback');

Route::resource('pages','PagesController');

// Terms of service & privacy
Route::get('/policy-data',function(){
    return view('/terms/policy-data')->with('page','privacy');
});

Route::get('/policy-terms',function(){
    return view('/terms/policy-terms')->with('page','privacy');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    // extension
    Route::get('extension-sales','ExtensionController@index');
    Route::post('extension-ajax','ExtensionController@ajax');
    Route::post('extension-post','ExtensionController@post');
    Route::post('extension-delete','ExtensionController@delete');
    // 

    // Pages
    Route::post('/pg_sheet_list','PagesController@list');
    Route::post('/pg_sheet_list_expense','PagesController@list_expense');
    Route::post('/pg_sheet_list_refund','PagesController@list_refund');


    // Sales
    Route::post('pages/store','PagesController@store')->middleware('verified');
    Route::post('pages/store_expense','PagesController@store_expense')->middleware('verified');

    // spreadsheet
    Route::resource('spreadsheet','SpreadsheetController');

    Route::get('yearly-breakdown','SpreadsheetController@year_break');

    Route::post('yearly-req','SpreadsheetController@year_req');

    Route::post('spreadsheet/rename','SpreadsheetController@rename');

    Route::post('spreadsheet/test','SpreadsheetController@test');

    Route::post('spreadsheet/summary','SpreadsheetController@summary');

    Route::post('spreadsheet/list_update','SpreadsheetController@list_update');

    Route::post('spreadsheet/list_delete','SpreadsheetController@list_delete');

    Route::post('spreadsheet/update','SpreadsheetController@update');

    Route::post('spreadsheet/select','SpreadsheetController@select');

    Route::post('spreadsheet/edit_sale','SpreadsheetController@edit_sale');

    Route::post('spreadsheet/edit_expense','SpreadsheetController@edit_expense');

    Route::post('spreadsheet/delete_sale','SpreadsheetController@delete_sale');

    Route::post('spreadsheet/delete_expense','SpreadsheetController@delete_expense');

    Route::post('spreadsheet/destroy','SpreadsheetController@destroy');

    Route::post('spreadsheet/store','SpreadsheetController@store');

    Route::post('spreadsheet/sheet_list','SpreadsheetController@sheet_list');

    Route::post('spreadsheet/yearly','SpreadsheetController@yearly');

    Route::get('print','SpreadsheetController@print');

    Route::get('paginate','SpreadsheetController@paginate');

    Route::get('paginate_ex','SpreadsheetController@paginate_ex');

    Route::get('download','SpreadsheetController@download');

    // Stripe

    Route::resource('payment','PaymentController');

    Route::get('/payment','PaymentController@payment_page');

    Route::post('/stripe-payment', 'PaymentController@payment');

    Route::post('/cancel_subscription', 'PaymentController@cancel_subscription');

    Route::post('/resume_subscription', 'PaymentController@resume_subscription');
    // Paypal
    // Route::resource('payment_paypal','PaymentController');

    // new paypal

        // success
        Route::post('/paypal-sub-approved','PaypalController@paypal_sub_approved');
        // check

    Route::get('/payment_paypal','PaymentController@payment_paypal');
    Route::post('/payment_paypal','PaymentController@payment_paypal');

    // Account
    Route::get('/home','AccountController@index')->name('home');

    Route::get('/subscription', 'AccountController@subscription');

    Route::get('/editpayment', 'AccountController@editpayment');

    Route::get('/settings','AccountController@settings');

    Route::post('/paymentchange','PaymentController@paymentchange');

    Route::post('account/change_tax','AccountController@change_tax');

    // refund/expense
    Route::get('expense','PagesController@expense');

    Route::get('refund','PagesController@refund');


    // Auto

    //etsy
    Route::get('auto/etsy','EtsyController@index');


    Route::get('auto/etsy/account','EtsyController@account');


    Route::get('auto/etsy/account-connect','EtsyController@connect');


    Route::get('/auto/etsy/sold/{shop_id}','EtsyController@sold');

    Route::post('/auto/etsy/add-sold-listing','EtsyController@addSoldListing');

  

    // Route::get('auto/ebay','AutoController@ebay_auto');
    // Route::get('auto/etsy','AutoController@etsy_auto');
    // Route::post('auto/account','AutoController@account');
    // Route::post('auto/sold','AutoController@sold');
    // Route::post('auto/active','AutoController@active');
    // Route::post('auto/import','AutoController@import');
    Route::get('/auto/ebay','AutoController@ebay_auto');
    Route::get('/auto/sold-item','AutoController@ebay_sold_item');

    Route::post('/auto/account','AutoController@account');
    Route::post('/auto/ebay_session','AutoController@ebay_session');

    Route::post('/auto/etsyAuthentication','AutoController@etsyAuthentication');

    Route::get('/auto/create_acc_ebay','AutoController@create_acc_ebay');
    Route::get('/auto/delete_acc_ebay','AutoController@delete_acc_ebay');

    Route::post('/auto/sold','AutoController@sold');

    Route::post('/auto/active','AutoController@active');

    Route::post('/auto/import','AutoController@import');


    Route::post('/auto/etsy_sold','AutoController@sold_etsy');

    Route::post('/auto/etsy_active','AutoController@active_etsy');

    Route::post('/auto/etsy_import','AutoController@import_etsy');
    
    Route::post('/auto/delete_acc_etsy','EtsyController@delete_acc_etsy');

    //START : auto ebay by ward
    Route::get('/auto/ebayfeelist','AutoController@ebayfeelist');
    Route::post('/auto/multinewsheet','AutoController@multinewsheet');
    Route::post('/autonewsheet','AutoController@autoebay_newsheet');
    // END : auto ebay by ward
    
    Route::get('testapi','AutoController@testapi');
    Route::get('getOauthtoken','AutoController@getOauthtoken');
    Route::get('promotionlist','AutoController@promotionlist');
    Route::get('testpromotion','AutoController@promotionlist');





    // Etsy Email Controller
    Route::get('/email/etsy','EtsyEmailController@index');

});