<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\BannerService;

use App\Http\Services\PageService;

use App\Http\Requests\Backend\BannerCreate;

use App\Http\Requests\Backend\BannerUpdate;

use Illuminate\Http\Response;

class BannerController extends Controller
{
    /**
     * Create variable bannerService
     * 
     * @var $bannerService
     */
    protected $bannerService;

    /**
     * __construct
     *
     * @param BannerService $bannerService - callback object
     * @param PageService   $pageService   - callback object
     */
    public function __construct(
        BannerService $bannerService,
        PageService $pageService
    ) {
        $this->bannerService = $bannerService;
        $this->pageService = $pageService;
    }

    /**
     * Get view index banner in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = $request->get('items') ?? config('constants.pagination');
        $banners = $this->bannerService->getBannerList($pagination);
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Get view create banner in admin management
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = $this->pageService->getPageActiveList();
        return view('backend.banner.create', compact('pages'));
    }

    /**
     * Store banner in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(BannerCreate $request)
    {
        $response = $this->bannerService->storeBanner($request);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.banners.index')->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Get view edit banner in admin management
     * 
     * @param Request            $request - call request send to function
     * @param \App\Models\Banner $banner  - banner detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $banner)
    {
        $pages = $this->pageService->getPageActiveList();
        $banner = $this->bannerService->getInformationBanner($banner);
        return view('backend.banner.edit', compact('pages', 'banner'));
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - call request send to function
     * @param \App\Models\Banner $banner  - banner detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdate $request, $banner)
    {
        $response = $this->bannerService->updateBanner($request, $banner);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.banners.edit', $banner)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information banner
     * 
     * @param \App\Models\Banner $banner - banner detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($banner)
    {
        $response = $this->bannerService->deleteBanner($banner);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
