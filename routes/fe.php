<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\SubscribeController;
// FRONTEND
if (in_array(Request::segment(1), config('constants.multilang'))) {
	$locale = Request::segment(1);
	app()->setLocale(Request::segment(1));
} else {
	app()->setLocale(config('app.locale'));
	$locale = "";
}
Route::group(
	[
		'middleware' => ['frontend.locale'],
		'prefix' => $locale
	],
	function () {
		Route::get('/thong-tin-khach-hang', 'Frontend\HomeController@getInfoCustomer')->name('info-customter');
		Route::post('/thong-tin-khach-hang', 'Frontend\HomeController@postInfoCustomer');
		
		Route::group([], function () {

			Route::post('cart/add-product-to-cart', 'Frontend\CartController@addToCart');

			Route::post('cart/update-product-to-cart', 'Frontend\CartController@updateToCart');

			Route::post('cart/remove-product-to-cart', 'Frontend\CartController@removeToCart');

			Route::get('frontend/assets/{name}', 'Frontend\HomeController@getImages')->where('name', '.*');

			Route::get('storage/{name}', 'Frontend\HomeController@getImageStorage')->where('name', '.*');

			Route::get('/' . __('route.cart'), 'Frontend\HomeController@getCart')->name('cart');

			Route::get('/' . __('route.checkout'), 'Frontend\HomeController@getCheckOut')->name('checkout');

			Route::post('/rate', 'Frontend\HomeController@postRate')->name('rate');

			Route::post('/' . __('route.logout'), 'Frontend\AuthController@logout')->name('logout');
		});

		

		Route::post('/load-view-product-tab', 'Frontend\HomeController@loadViewProductTab');

		Route::post('product/view-popup-detail', 'Frontend\HomeController@viewPopupDetailProduct');

		Route::get('/', 'Frontend\HomeController@getIndex')->name('home');

		Route::get('/collections/all', 'Frontend\HomeController@getConllections')->name('category-all');

		Route::get('/collections/'.__('route.new_product'), 'Frontend\HomeController@getConllectionsNew')->name('new-products');

		Route::get('/collections/'.__('route.best_seller'), 'Frontend\HomeController@getConllectionsSelling')->name('best-seller');

		Route::get('/collections/'.__('route.sale_off'), 'Frontend\HomeController@getConllectionsSale')->name('sale-off');

		Route::get('/collections/{slug}', 'Frontend\HomeController@getConllectionSlug')->name('category-slug');

		Route::get('/' . __('route.news'), 'Frontend\HomeController@getListNews')->name('news');

		Route::get('/' . __('route.news') . '/{slug}', 'Frontend\HomeController@getDetailNews')->name('news.detail');

		Route::get('/' . __('route.video'), 'Frontend\HomeController@getListVideo')->name('video');

		Route::get('/' . __('route.tags') . '/{slug}', 'Frontend\HomeController@getNewsByTags');

		Route::get('/'.__('route.checkout'), 'Frontend\HomeController@getCheckOut')->name('checkout');

		Route::post('/send-email', 'Frontend\HomeController@postSendEmail')->name('send.email');

		Route::get('/' . __('route.search') , 'Frontend\SearchController@index')->name('search.index');

		Route::post('/submit-order', 'Frontend\CartController@postOrder')->name('submit-order');

		Route::post('/submit-comment', 'Frontend\HomeController@postSubmitComment')->name('submit-comment');

		Route::group(
			[
				'as' => 'contact.',
				'prefix' => __('route.contact')
			],
			function () {
				Route::get('', 'Frontend\ContactController@index')->name('index');
				Route::post('', 'Frontend\ContactController@sendContact');
			}
		);

		Route::get('/' . __('route.login'), 'Frontend\AuthController@index')->name('login.get');
		Route::post('/' . __('route.login'), 'Frontend\AuthController@login')->name('login.post');

		Route::post('/' . __('route.forget-password'), 'Frontend\AuthController@forgetPassword')->name('forget-password');

		Route::get('/reset-password/{token}', 'Frontend\AuthController@getResetPassword')->name('password.reset');
		Route::post('/reset-password', 'Frontend\AuthController@postResetPassword')->name('reset.post');

		Route::get('/' . __('route.register'), 'Frontend\AuthController@getRegisterAccount')->name('register.get');
		Route::post('/' . __('route.register'), 'Frontend\AuthController@postRegisterAccount')->name('register.post');

		Route::get('/unsubscribe', [SubscribeController::class, 'unsubscribe'])->name('subscribes.unsubscribe');

		
		Route::get('confirm', 'Frontend\HomeController@getConfirm')->name('confirm');
		Route::get('/{slug}', 'Frontend\HomeController@getDetailProduct')->name('detail');


	}
);
