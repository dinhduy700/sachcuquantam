<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\ProductCategoryService;
use App\Http\Services\SettingService;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['frontend.layouts.header'], ProductCategoryService::class);
        View::composer('frontend.*', SettingService::class);
    }
}
