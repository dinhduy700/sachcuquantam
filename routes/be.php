<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\SubscribeController;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth', 'admin.role']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
// BACKEND
Route::group(
    [
        'as' => 'admin.',
        'prefix' => 'admin',
        'middleware' => ['web']
    ],
    function () {
        Route::get('/login', [AuthController::class, 'getLogin'])->name('login.get');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/switchLocale', [AuthController::class, 'switchLocale'])->name('locale');
        // Admin Routes
        Route::group(
            [
                'middleware' => ['admin.locale', 'auth', 'admin.role']
            ],
            function () {
                Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

                Route::get('load-notifications', [AuthController::class, 'loadNotifications'])->name('notification.load');

                Route::delete('delete-notifications', [AuthController::class, 'deleteNotifications'])->name('notification.delete');

                Route::get('detail-notifications', [AuthController::class, 'detailNotifications'])->name('notification.detail');

                Route::group(
                    [
                        'as' => 'categories.',
                        'prefix' => 'categories'
                    ],
                    function () {
                        Route::get('', [ProductCategoryController::class, 'index'])->name('index');
                        Route::post('/sortable', [ProductCategoryController::class, 'sortable'])->name('sortable');
                        Route::get('create', [ProductCategoryController::class, 'create'])->name('create');
                        Route::post('store', [ProductCategoryController::class, 'store'])->name('store');
                        Route::get('edit/{category}', [ProductCategoryController::class, 'edit'])->name('edit');
                        Route::post('update/{category}', [ProductCategoryController::class, 'update'])->name('update');
                        Route::delete('delete/{category}', [ProductCategoryController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'products.',
                        'prefix' => 'products'
                    ],
                    function () {
                        Route::get('', [ProductController::class, 'index'])->name('index');
                        Route::get('create', [ProductController::class, 'create'])->name('create');
                        Route::post('create', [ProductController::class, 'store'])->name('create.post');
                        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('edit');
                        Route::post('edit/{product}', [ProductController::class, 'update'])->name('edit.post');
                        Route::get('get-category', [ProductController::class, 'getCategory'])->name('category');
                        Route::delete('delete/{product}', [ProductController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'users.',
                        'prefix' => 'users'
                    ],
                    function () {
                        Route::get('', [UserController::class, 'index'])->name('index');
                        Route::get('create', [UserController::class, 'create'])->name('create');
                        Route::post('store', [UserController::class, 'store'])->name('store');
                        Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
                        Route::post('update/{user}', [UserController::class, 'update'])->name('update');
                        Route::delete('delete/{user}', [UserController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'customers.',
                        'prefix' => 'customers'
                    ],
                    function () {
                        Route::get('', [CustomerController::class, 'index'])->name('index');
                        Route::get('create', [CustomerController::class, 'create'])->name('create');
                        Route::post('store', [CustomerController::class, 'store'])->name('store');
                        Route::get('edit/{customer}', [CustomerController::class, 'edit'])->name('edit');
                        Route::post('update/{customer}', [CustomerController::class, 'update'])->name('update');
                        Route::delete('delete/{customer}', [CustomerController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'roles.',
                        'prefix' => 'roles'
                    ],
                    function () {
                        Route::get('', [RoleController::class, 'index'])->name('index');
                        Route::get('create', [RoleController::class, 'create'])->name('create');
                    }
                );

                Route::group(
                    [
                        'as' => 'orders.',
                        'prefix' => 'orders'
                    ],
                    function () {
                        Route::get('', [OrderController::class, 'index'])->name('index');
                        Route::get('create', [OrderController::class, 'create'])->name('create');
                        Route::get('edit/{edit}', [OrderController::class, 'edit'])->name('edit');
                        Route::post('edit/{product}', [OrderController::class, 'update'])->name('edit.post');
                    }
                );

                Route::group(
                    [
                        'as' => 'banners.',
                        'prefix' => 'banners'
                    ],
                    function () {
                        Route::get('', [BannerController::class, 'index'])->name('index');
                        Route::get('create', [BannerController::class, 'create'])->name('create');
                        Route::post('store', [BannerController::class, 'store'])->name('store');
                        Route::get('edit/{banner}', [BannerController::class, 'edit'])->name('edit');
                        Route::post('update/{banner}', [BannerController::class, 'update'])->name('update');
                        Route::delete('delete/{banner}', [BannerController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'news.',
                        'prefix' => 'news'
                    ],
                    function () {
                        Route::get('', [NewsController::class, 'index'])->name('index');
                        Route::get('create', [NewsController::class, 'create'])->name('create');
                        Route::post('store', [NewsController::class, 'store'])->name('store');
                        Route::get('edit/{news}', [NewsController::class, 'edit'])->name('edit');
                        Route::post('update/{news}', [NewsController::class, 'update'])->name('update');
                        Route::delete('delete/{news}', [NewsController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'tags.',
                        'prefix' => 'tags'
                    ],
                    function () {
                        Route::get('', [TagController::class, 'index'])->name('index');
                        Route::get('create', [TagController::class, 'create'])->name('create');
                        Route::post('store', [TagController::class, 'store'])->name('store');
                        Route::get('edit/{tag}', [TagController::class, 'edit'])->name('edit');
                        Route::post('update/{tag}', [TagController::class, 'update'])->name('update');
                        Route::delete('delete/{tag}', [TagController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'videos.',
                        'prefix' => 'videos'
                    ],
                    function () {
                        Route::get('', [VideoController::class, 'index'])->name('index');
                        Route::get('create', [VideoController::class, 'create'])->name('create');
                        Route::post('store', [VideoController::class, 'store'])->name('store');
                        Route::get('edit/{video}', [VideoController::class, 'edit'])->name('edit');
                        Route::post('update/{video}', [VideoController::class, 'update'])->name('update');
                        Route::delete('delete/{video}', [VideoController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'brands.',
                        'prefix' => 'brands'
                    ],
                    function () {
                        Route::get('', [BrandController::class, 'index'])->name('index');
                        Route::get('create', [BrandController::class, 'create'])->name('create');
                        Route::post('store', [BrandController::class, 'store'])->name('store');
                        Route::get('edit/{brand}', [BrandController::class, 'edit'])->name('edit');
                        Route::post('update/{brand}', [BrandController::class, 'update'])->name('update');
                        Route::delete('delete/{brand}', [BrandController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'contacts.',
                        'prefix' => 'contacts'
                    ],
                    function () {
                        Route::get('', [ContactController::class, 'index'])->name('index');
                        Route::get('edit/{contact}', [ContactController::class, 'edit'])->name('edit');
                        Route::post('update/{contact}', [ContactController::class, 'update'])->name('update');
                        Route::delete('delete/{contact}', [ContactController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'comments.',
                        'prefix' => 'comments'
                    ],
                    function () {
                        Route::get('', [CommentController::class, 'index'])->name('index');
                        Route::get('edit/{comment}', [CommentController::class, 'edit'])->name('edit');
                        Route::post('update/{comment}', [CommentController::class, 'update'])->name('update');
                        Route::delete('delete/{comment}', [CommentController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'subscribes.',
                        'prefix' => 'subscribes'
                    ],
                    function () {
                        Route::get('', [SubscribeController::class, 'index'])->name('index');
                        Route::post('update/{subscribe}', [SubscribeController::class, 'update'])->name('update');
                        Route::delete('delete/{subscribe}', [SubscribeController::class, 'delete'])->name('delete');
                    }
                );

                Route::group(
                    [
                        'as' => 'setting.',
                        'prefix' => 'setting'
                    ],
                    function () {
                        Route::get('', [SettingController::class, 'index'])->name('index');
                        Route::post('save', [SettingController::class, 'save'])->name('save');
                    }
                );
                
                Route::group(
                    [
                        'as' => 'pages.',
                        'prefix' => 'pages'
                    ],
                    function () {
                        Route::get('', [PageController::class, 'index'])->name('index');
                        Route::get('edit/{page}', [PageController::class, 'edit'])->name('edit');
                        Route::post('update/{page}', [PageController::class, 'update'])->name('update');
                    }
                );
            }
        );
    }
);
