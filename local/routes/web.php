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

// Route::get('/', function () {
//     return view('theme.index');
// });

Route::group(['middleware' => ['web']], function(){
	Route::get('/', 'Theme\ThemeController@index');
	Route::get('/about-us', 'Theme\ThemeController@about_us');
	Route::get('/contact-us', 'Theme\ThemeController@contact_us');
	Route::post('/contact-us/send_message', 'Theme\ThemeController@send_message')->name('send_message');

	Route::get('/blog/{slug}/', 'Theme\ThemeController@view_blog');

	Route::get('/shop', 'Theme\ThemeController@shop');
	Route::get('/shop/{id}', 'Theme\ThemeController@shop_detail');

	Route::get('/cart', 'Theme\ThemeController@cart')->name('mycart')->middleware('auth');
	Route::post('/cart/removeItem', 'Theme\ThemeController@cartRemoveItem')->name('cartRemoveItem')->middleware('auth');
	Route::post('/cart/updateCart', 'Theme\ThemeController@updateCart')->name('updateCart')->middleware('auth');
	// Route::get('/checkout', 'Theme\ThemeController@checkout');

	Route::get('get_cart_product', 'Theme\ThemeController@getMyCart')->name('getMyCart');
	Route::post('getSubCategoryByCategoryId', 'Theme\ThemeController@getSubCategoryByCategoryId')->name('getSubCategoryByCategoryId');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' =>['auth']], function(){
	// admin routes
	Route::get('/dashboard', 'HomeController@index')->name('home')->middleware('admin');

	Route::group(['prefix' => 'backend'], function(){

		Route::get('/setting', 'HomeController@setting')->name('setting')->middleware('admin');
		Route::post('/setting/update', 'HomeController@updateSetting')->name('updateSetting')->middleware('admin');


		Route::resource('/blog', 'Admin\BlogController')->middleware('admin');

		Route::resource('/user', 'Admin\UserController')->middleware('admin');

		Route::resource('/product', 'Admin\ProductController')->middleware('admin');
		Route::post('/product_attachment/remove', 'Admin\ProductController@removeAttachment');

		Route::resource('/customer', 'Admin\CustomerController')->middleware('admin');

		Route::resource('/item', 'Admin\ItemController')->middleware('admin');

		Route::resource('/category', 'Admin\CategoryController')->middleware('admin');
		Route::resource('/sub_category', 'Admin\SubCategoryController')->middleware('admin');

		Route::resource('/order', 'Admin\OrderController')->middleware('admin');
		Route::get('order/customer/autocomplete', 'Admin\OrderController@customerAutocomplete')->middleware('admin');
		
		Route::get('/profile/{id}','HomeController@profile')->name('profile');
		Route::PUT('/profile/{id}/update','HomeController@profileUpdate')->name('profile.update');

		Route::get('/message','HomeController@message')->name('message.index')->middleware('admin');

		Route::post('/getItemByProduct', 'Admin\ItemController@getItemByProduct')->name('admin.getItemByProduct');

	});

	//customer routes
	Route::get('/home', 'MyCustomerController@index')->name('mycustomer.index')->middleware('customer');
	Route::get('/myorder', 'MyCustomerController@myorder')->name('myorder')->middleware('customer');

	Route::post('/add_to_cart', 'MyCustomerController@addCart')->name('add_to_cart');
	// Route::get('/checkout', 'MyCustomerController@checkout')->middleware('customer');
});


