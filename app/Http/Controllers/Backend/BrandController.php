<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\BrandService;

use App\Http\Requests\Backend\BrandRequest;

use Illuminate\Http\Response;

class BrandController extends Controller
{
    /**
     * Create variable brandService
     * 
     * @var $brandService
     */
    protected $brandService;

    /**
     * __construct
     *
     * @param BrandService $brandService - callback object
     */
    public function __construct(
        BrandService $brandService
    ) {
        $this->brandService = $brandService;
    }

    /**
     * Get view index news in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = $request->get('items') ?? config('constants.pagination');
        $search = $request->get('search');
        $status = $request->get('status');
        $sortBy = $request->get('sortBy');
        $brands = $this->brandService->getBrandList($pagination, $search, $status, $sortBy);
        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Get view create news in admin management
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store news in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $response = $this->brandService->storeBrand($request);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.brands.index')->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Get view edit news in admin management
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $brand)
    {
        $brand = $this->brandService->getInformationBrand($brand);
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update information news
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $brand)
    {
        $response = $this->brandService->updateBrand($request, $brand);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.brands.edit', $brand)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($brand)
    {
        $response = $this->brandService->deleteBrand($brand);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
