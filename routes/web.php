<?php

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
Auth::routes(['verify' => true]);

/* social login */
Route::get('auth/{provider}', 'Auth\LoginController@redirectToSocial')->name('auth.provider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleSocialCallback');
Route::get('social-success/{id?}', 'UserController@social_success')->name('user.social');
// we should use callback URI as above on social app setting.


Route::middleware(['auth','verified'])->group(function () {
    /* profile */
//    Route::get('auth/{provider}', 'Auth\LoginController@redirectToSocial')->name('auth.provider');
    Route::get('profile/{id?}', 'UserController@profile')->name('profile');
    Route::post('profile/{id?}/store', 'UserController@store')->name('profile.store');
    Route::get('detail/profile', 'UserController@profile_detail')->name('profile.detail');
    Route::get('profile/chatting/{id?}', 'UserController@chatting')->name('profile.chatting');
    Route::get('edit/profile/{id?}', 'UserController@profile_edit')->name('profile.edit');
    Route::post('profile/image/upload','UserController@upload_image')->name('profile.image.upload');
    Route::get('profile/image/uploaded','UserController@uploaded_image')->name('profile.image.uploaded');
    Route::any('user/{id?}/change_password','UserController@change_password')->name('user.change_password');
    Route::any('user/{id?}/store_newpassword','UserController@store_newpassword')->name('user.store_newpassword');
    Route::any('user/{id?}/make_deposit','UserController@make_deposit')->name('user.make_deposit');
    Route::any('user/{id?}/store_deposit','UserController@store_deposit')->name('user.store_deposit');
    Route::any('user/{id?}/membership','UserController@membership')->name('user.membership');
    Route::any('user/{id?}/upgrade_membership','UserController@upgrade_membership')->name('user.upgrade_membership');
    Route::get('admin','AdminController@home')->name('admin');
    Route::get('detail/admin','AdminController@admin_detail')->name('admin.detail');
    Route::post('upload/{id?}/valid_id','UserController@upload_id')->name('upload.id');

    Route::any('admin/user/{id?}/edit','AdminController@user_edit')->name('admin.user.edit');
    Route::any('admin/user/{id?}/delete','AdminController@user_delete')->name('admin.user.delete');
    Route::any('admin/user/{id?}/store','AdminController@user_store')->name('admin.user.store');
    Route::any('admin/user/{id?}/valid_id','AdminController@user_valid_id')->name('admin.user.valid_id');
    Route::any('admin/verify/{id?}/email','AdminController@verify_email')->name('admin.verify.email');
    Route::any('admin/create/user','AdminController@create_user')->name('admin.user.create');
    Route::any('admin/store/newuser','AdminController@store_newuser')->name('admin.newuser.store');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('product/bring_products', 'HomeController@bring_products')->name('bring.products');
Route::get('city_autocomplete', 'HomeController@city_autocomplete')->name('city.autocomplete');

/* Products */
Route::resource('products','ProductController');


Route::post('product/image/upload','ProductController@upload_image')->name('product.image.upload');

Route::get('product/image/uploaded','ProductController@uploaded_image')->name('product.image.uploaded');
Route::any('product/set/favorite','ProductController@set_favorite')->name('favor.products');

Route::get('singleproduct/{id}','SingleProductController@index')->name('singleshow');

/* Bidder */
Route::resource('bidders','BidderController');
Route::post('bidder/{id?}/update','BidderController@update')->name('bidders.update');
Route::any('bidder/{id?}/cancel','BidderController@cancel')->name('bidders.cancel');
Route::any('bidder/{id?}/complete','BidderController@complete')->name('bidders.complete');
Route::any('bidder/{id?}/destroy','BidderController@destroy')->name('bidders.destroy');
Route::any('bidder/{id?}/accept/{buyer_id?}','BidderController@accept')->name('bidders.accept');
Route::post('product/{id?}/update','ProductController@update')->name('products.update');
Route::any('product/{id?}/destroy','ProductController@destroy')->name('products.destroy');
Route::any('bidding/list','BidderController@bidding_list')->name('bidding.list');
Route::any('bidder/{id?}/feedback','BidderController@feedback')->name('bidders.feedback');
Route::any('bidder/{id?}/feed','BidderController@provide_feedback')->name('bidders.feed');
Route::any('bidder/{id?}/review','BidderController@show_review')->name('bidder.review');

/* Chat */
Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');
Route::post('/send', 'MessagesController@postSendMessage');
Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');
Route::any('chat/delete/{id?}','MessagesController@delete')->name('chat.delete');

Route::any('expert/{user?}/excel','UserController@excel')->name('export.excel');

//paypal route
Route::get('payment', 'PayPalController@payment')->name('payment');

Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');

Route::get('payment/success', 'PayPalController@success')->name('payment.success');

Route::post('/paypal-transaction-complete','UserController@paypal_success')->name('paypal.success');
