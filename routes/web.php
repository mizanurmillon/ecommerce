<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/my-order', [App\Http\Controllers\HomeController::class, 'MyOrder'])->name('my.order');
Route::get('/order-view/{id}',[App\Http\Controllers\HomeController::class, 'orderView'])->name('view.order');
//__support ticket__//
Route::get('/support-ticket', [App\Http\Controllers\HomeController::class, 'Ticket'])->name('support.ticket');
Route::get('/new-ticket', [App\Http\Controllers\HomeController::class, 'NewTicket'])->name('new.ticket');
Route::post('/store-ticket', [App\Http\Controllers\HomeController::class, 'StoreTicket'])->name('store.ticket');
Route::get('/view-ticket/{id}', [App\Http\Controllers\HomeController::class, 'ViewTicket'])->name('view.ticket');
Route::post('/reply-ticket', [App\Http\Controllers\HomeController::class, 'ReplyTicket'])->name('reply.ticket');

//___User route__//
Route::group(['namespace' => 'App\Http\Controllers\User'],function(){
    Route::get('/logout','ProfileController@Logout')->name('logout');
    Route::get('/password-change','ProfileController@passwordchange')->name('password');
    Route::post('/password-update','ProfileController@updatePassword')->name('update.password');
    //user review route-------
    Route::get('/user-review','ProfileController@Review')->name('user.review');
    Route::post('/review-store','ProfileController@Store')->name('review.store');
    Route::post('/review-update','ProfileController@Update')->name('review.update');
    //wishlist route-------
    Route::get('/add-to-wishlist/{id}','WishlistController@addwishlist');
    Route::get('/wishlist','WishlistController@wishlist')->name('wishlist');
    Route::get('/wishlist-clear','WishlistController@destroy')->name('wishlist.clear');
    Route::get('/remove-wishlist/{id}','WishlistController@Remove')->name('remove.wishlist');
    Route::get('/count-wishlist','WishlistController@Count')->name('count.wishlist');
    //compare route-------
    Route::get('/add-to-compare/{id}','CompareController@addcompare');
    Route::get('/count-compare','CompareController@countCompare')->name('count.compare');
    Route::get('/compare','CompareController@Compare')->name('compare');
    Route::get('/compare-clear','CompareController@remove')->name('compare.clear');
    //product review route-----
    Route::post('/product-review','ReviewController@store')->name('review.store');
});

Route::group(['namespace' => 'App\Http\Controllers\Front'],function(){
    Route::get('/','FrontendController@index');
    Route::get('/product-details/{product_slug}','FrontendController@productDetails')->name('product.details');
    Route::get('/today-product/{product_slug}','FrontendController@TodayProduct')->name('today.product');
    //All product route------
    Route::get('/all-product','FrontendController@allProduct')->name('all.product');
    //brandwise product route------
    Route::get('/brandwise-product/{id}','FrontendController@BrandwiseProduct')->name('brandwise.product');
    //categorywise product route-----
    Route::get('/categorywise-product/{id}','FrontendController@CategorywiseProduct')->name('categorywise.product');
    //subcategorywise product route------
    Route::get('/subcategorywise-product/{id}','FrontendController@SubcategorywiseProduct')->name('subcategorywise.product');
    //all featured product route-----
    Route::get('/featured-product','FrontendController@featuredProduct')->name('all.featured.product');
    //page show route-----
    Route::get('/page-view/{page_slug}','FrontendController@pageView')->name('page.view');
    Route::post('/send-contact','FrontendController@sendContact')->name('send.contact');
    //cart route here------
    Route::post('/add-to-cart','CartController@addCart')->name('add.to.cart');
    Route::get('/all-cart','CartController@allCart')->name('all.cart');
    Route::get('/cartproduct-remove/{rowId}','CartController@remove');
    Route::get('/my-cart','CartController@Mycart')->name('my.cart');
    Route::get('/update-color/{rowId}/{color}','CartController@Color');
    Route::get('/update-size/{rowId}/{size}','CartController@Size');
    Route::get('/update-qty/{rowId}/{qty}','CartController@Qty');
    
    //chackout route here-----
    Route::get('/chackout','ChackoutController@Chackout')->name('chackout');
    Route::post('/order-place','ChackoutController@OrderPlace')->name('order.place');
    //aamerpay payment gateway----
    Route::post('success','ChackoutController@success')->name('success');
    Route::post('fail','ChackoutController@fail')->name('fail');
    Route::get('cancel','ChackoutController@cancel')->name('cancel');


    //apply coupon route ------
    Route::post('/apply-coupon','ChackoutController@ApplyCoupon')->name('apply.coupon');
    Route::get('/remove-coupon','ChackoutController@removeCoupon')->name('coupon.remove');

    //newsletter route-----
    Route::post('/store-newsletter','FrontendController@store')->name('store.newsletter');
    Route::post('/newsletter','FrontendController@newsletterStore')->name('newsletter');

    //order tracking route------
    Route::get('/order-tracking','FrontendController@orderTracking')->name('order.tracking');
    Route::post('/chack-order','FrontendController@ChackOrder')->name('chack.order');
});
Route::group(['namespace' => 'App\Http\Controllers\Auth'],function(){
    //socilalite login with google route----
    Route::get('/oauth/{driver}','LoginController@redirectToProvider')->name('socile.oauth');
    Route::get('/oauth/{driver}/callback','LoginController@handleProviderCallback')->name('socile.callback');
});