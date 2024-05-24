<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Services\SearchService;
use App\Http\Services\BannerService;
use App\Http\Services\SettingService;

class SearchController extends Controller {
    protected $searchService;
    protected $bannerService;
    protected $settingService;

    public function __construct(
        SearchService $searchService,
        BannerService $bannerService,
        SettingService $settingService
    ) {
        $this->searchService = $searchService;
        $this->bannerService = $bannerService;
        $this->settingService = $settingService;
    }

    public function index(Request $request) {
        $pagination = config('constants.pagination');
        $search = $request->get('search');

        $products = $this->searchService->searchProductByName($pagination, $search);
        $setting = $this->settingService->getSettingService();
        $banners = $this->bannerService->getBannerListIndex(0);

        return view('frontend.search', ['products' => $products, 'banners' => $banners, 'setting' => $setting]);
    }
}
