<?php

use Illuminate\Support\Facades\Route;



Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class,'AdminLogin'])->name('admin.login');

Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'is_admin', 'prefix'=>'admin'],function(){
    //Admin Profile Route
    Route::get('/home','AdminController@Admin')->name('admin.home');
    Route::get('/logout','AdminController@AdminLogout')->name('admin.logout');
    Route::get('/password/change','AdminController@PasswordChange')->name('password.change');
    Route::post('/password/update','AdminController@PasswordUpdate')->name('password.update');
    //Client review route-------
    Route::get('/pending-review','AdminController@pendingReview')->name('pending.review');
    Route::delete('/review-delete/{id}','AdminController@destroy')->name('user.review.delete');
    Route::get('/edit/{id}','AdminController@edit');
    Route::post('/review-update','AdminController@reviewUpdate')->name('user.review.update');
    //category route---------
    Route::group(['prefix'=>'category'],function(){
       Route::get('/','CategoryController@index')->name('category'); 
       Route::post('/store','CategoryController@store')->name('category.store');
       Route::get('/edit/{id}','CategoryController@edit');
       Route::post('/update','CategoryController@update')->name('category.update');
       Route::delete('/delete/{id}','CategoryController@destroy')->name('category.delete'); 
    });
    //subcategory route---------
    Route::group(['prefix'=>'subcategory'],function(){
       Route::get('/','SubcategoryController@index')->name('subcategory'); 
       Route::post('/store','SubcategoryController@store')->name('subcategory.store');
       Route::get('/edit/{id}','SubcategoryController@edit');
       Route::post('/update','SubcategoryController@update')->name('subcategory.update');
       Route::delete('/delete/{id}','SubcategoryController@destroy')->name('subcategory.delete'); 
    });
    //child category route---------
    Route::group(['prefix'=>'child-category'],function(){
       Route::get('/','ChildcategoryController@index')->name('child.category'); 
       Route::post('/store','ChildcategoryController@store')->name('childcategory.store');
       Route::get('/edit/{id}','ChildcategoryController@edit');
       Route::post('/update','ChildcategoryController@update')->name('childcategory.update');
       Route::delete('/delete/{id}','ChildcategoryController@destroy')->name('childcategory.delete'); 
    });
    //brand route---------
    Route::group(['prefix'=>'brand'],function(){
       Route::get('/','BrandController@index')->name('brand'); 
       Route::post('/store','BrandController@store')->name('brand.store');
       Route::get('/edit/{id}','BrandController@edit');
       Route::post('/update','BrandController@update')->name('brand.update');
       Route::delete('/delete/{id}','BrandController@destroy')->name('brand.delete'); 
    });
    //warehouse route---------
    Route::group(['prefix'=>'warehouse'],function(){
       Route::get('/','WarehouseController@index')->name('warehouse'); 
       Route::post('/store','WarehouseController@store')->name('warehouse.store');
       Route::get('/edit/{id}','WarehouseController@edit');
       Route::post('/update','WarehouseController@update')->name('warehouse.update');
       Route::delete('/delete/{id}','WarehouseController@destroy')->name('warehouse.delete'); 
    });
    //coupon route---------
    Route::group(['prefix'=>'coupon'],function(){
       Route::get('/','CouponController@index')->name('coupon'); 
       Route::post('/store','CouponController@store')->name('coupon.store');
       Route::get('/edit/{id}','CouponController@edit');
       Route::post('/update','CouponController@update')->name('coupon.update');
       Route::delete('/delete/{id}','CouponController@destroy')->name('coupon.delete'); 
    });
    //pickuppoint route---------
    Route::group(['prefix'=>'pickuppoint'],function(){
       Route::get('/','PickuppointController@index')->name('pickuppoint'); 
       Route::post('/store','PickuppointController@store')->name('pickuppoint.store');
       Route::get('/edit/{id}','PickuppointController@edit');
       Route::post('/update','PickuppointController@update')->name('pickuppoint.update');
       Route::delete('/delete/{id}','PickuppointController@destroy')->name('pickuppoint.delete'); 
    });

    //products route---------
    Route::group(['prefix'=>'product'],function(){
       Route::get('/','ProductsController@index')->name('product.manage'); 
       Route::get('/create','ProductsController@create')->name('create.product');
       Route::post('/store','ProductsController@store')->name('product.store');
       Route::get('/edit/{id}','ProductsController@edit')->name('product.edit');
       Route::post('/update','ProductsController@update')->name('product.update');
       Route::delete('/delete/{id}','ProductsController@destroy')->name('product.delete');
       Route::get('/deactive/{id}','ProductsController@deactive')->name('product.deactive');
       Route::get('/active/{id}','ProductsController@active')->name('product.active');
       Route::get('/deactive-todaydeal/{id}','ProductsController@todaydealDeactive')->name('deactive.todaydeal');
       Route::get('/active-todaydeal/{id}','ProductsController@todaydealActive')->name('active.todaydeal');
       Route::get('/deactive-status/{id}','ProductsController@statusDeactive')->name('deactive.status');
       Route::get('/active-status/{id}','ProductsController@statusActive')->name('active.status');
    });

    //order route---------
    Route::group(['prefix'=>'order'],function(){
       Route::get('/','OrderController@index')->name('admin.order.index'); 
       Route::get('/recieved-order','OrderController@orderRecieved')->name('order.recieved');
       Route::get('/edit/{id}','OrderController@Edit');
       Route::get('/view/{id}','OrderController@orderDetails');
       Route::post('/update','OrderController@update')->name('order.update');
       Route::delete('/delete/{id}','OrderController@destroy')->name('order.delete');
       Route::get('/report','OrderController@orderReport')->name('order.report'); 
       Route::get('/report-print','OrderController@orderReportPrint')->name('order.report.print'); 
    });

   //setting route-------
    //seo setting----
   Route::group(['prefix'=>'setting'],function(){
      Route::get('/seo','SettingController@seoSetting')->name('seo.setting'); 
      Route::post('/seo-update/{id}','SettingController@seoUpdate')->name('seo.update');
      //smtp setting----
      Route::get('/smtp','SettingController@smtpSetting')->name('smtp.setting'); 
      Route::post('/smtp-update/{id}','SettingController@smtpUpdate')->name('smtp.update');
      //website setting-----
      Route::get('/website','SettingController@websiteSetting')->name('website.setting'); 
      Route::post('/website-update/{id}','SettingController@websiteUpdate')->name('update.website');
      //payment getaway----
      Route::get('/payment-getaway','SettingController@PaymentGeatway')->name('payment.getaway'); 
      Route::post('/update-aamerpay','SettingController@UpdateAamerpay')->name('update.aamerpay');
      Route::post('/update-surjopay','SettingController@UpdateSurjopay')->name('update.surjopay');
      Route::post('/update-ssl','SettingController@UpdateSSL')->name('update.ssl');
   });
   //warehouse route---------
   Route::group(['prefix'=>'page'],function(){
      Route::get('/','PageController@index')->name('page'); 
      Route::post('/store','PageController@store')->name('page.store');
      Route::get('/edit/{id}','PageController@edit');
      Route::post('/update','PageController@update')->name('page.update');
      Route::delete('/delete/{id}','PageController@destroy')->name('page.delete'); 
   });
   //ticket route---------
   Route::group(['prefix'=>'ticket'],function(){
      Route::get('/','TicketController@index')->name('index.ticket'); 
      Route::get('/show/{id}','TicketController@Show')->name('ticket.show'); 
      Route::post('/store','TicketController@storeTicket')->name('admin.store.reply');
      Route::get('/close-ticket/{id}','TicketController@CloseTicket')->name('close.ticket');
      Route::delete('/delete/{id}','TicketController@destroy')->name('ticket.delete'); 
   });
   //user role route---------
   Route::group(['prefix'=>'role'],function(){
      Route::get('/','RoleController@index')->name('manage.role');
      Route::get('/create-role','RoleController@create')->name('create.role'); 
      Route::post('/store-role','RoleController@store')->name('store.role'); 
      Route::get('/delete-role/{id}','RoleController@destroy')->name('role.delete');
       
   });
  
});

