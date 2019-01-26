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

Route::get('/', function () {
	return redirect()->route('login');
})->name('/');

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
	Route::get('/dashboard', 'HomeController@index')->name('dashboard');
	
	/* User */
	Route::prefix('users')->group(function () {
		Route::get('/', 'UserController@index')->name('user-list');
		Route::post('/status', 'UserController@status')->name('user-toggle-status');
	});

	/* Video Category */
	Route::prefix('video-categories')->group(function () {
		Route::get('/', 'VideoCategoryController@index')->name('video-category-list');
		Route::get('add', 'VideoCategoryController@addPage')->name('video-category-add');
		Route::get('edit/{id}', 'VideoCategoryController@editPage')->name('video-category-edit');
		Route::post('create', 'VideoCategoryController@create')->name('video-category-create');
		Route::post('update', 'VideoCategoryController@update')->name('video-category-update');
		Route::post('delete', 'VideoCategoryController@delete')->name('video-category-delete');
		Route::post('status', 'VideoCategoryController@status')->name('video-category-toggle-status');
		Route::post('featured', 'VideoCategoryController@featured')->name('video-category-toggle-featured');
	});
	
	/* Video Category */
	Route::prefix('videos')->group(function () {
		Route::get('/', 'VideoController@index')->name('video-list');
		Route::get('add', 'VideoController@addPage')->name('video-add');
		Route::get('edit/{id}', 'VideoController@editPage')->name('video-edit');
		Route::post('create', 'VideoController@create')->name('video-create');
		Route::post('update', 'VideoController@update')->name('video-update');
		Route::post('delete', 'VideoController@delete')->name('video-delete');
		Route::post('status', 'VideoController@status')->name('video-toggle-status');
	});

	/* Coupon */
	Route::prefix('coupons')->group(function () {
		Route::get('/', 'CouponController@index')->name('coupon-list');
		Route::get('add', 'CouponController@addPage')->name('coupon-add');
		Route::get('edit/{id}', 'CouponController@editPage')->name('coupon-edit');
		Route::post('create', 'CouponController@create')->name('coupon-create');
		Route::post('update', 'CouponController@update')->name('coupon-update');
		Route::post('delete', 'CouponController@delete')->name('coupon-delete');
		Route::post('status', 'CouponController@status')->name('coupon-toggle-status');
	});

	/* Customer */
	Route::prefix('customers')->group(function () {
		Route::get('/', 'CustomerController@index')->name('customer-list');
		Route::get('add', 'CustomerController@addPage')->name('customer-add');
		Route::get('edit/{id}', 'CustomerController@editPage')->name('customer-edit');
		Route::post('create', 'CustomerController@create')->name('customer-create');
		Route::post('update', 'CustomerController@update')->name('customer-update');
		Route::post('delete', 'CustomerController@delete')->name('customer-delete');
		Route::post('status', 'CustomerController@status')->name('customer-toggle-status');
	});


});
