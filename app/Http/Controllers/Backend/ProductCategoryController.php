<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProductCategoryService;
use App\Http\Requests\Backend\ProductCategoryCreate;
use App\Http\Requests\Backend\ProductCategoryUpdate;
use Illuminate\Http\Response;

class ProductCategoryController extends Controller
{
    /**
     * Create variable productCategoryService
     * 
     * @var $productCategoryService
     */
    protected $productCategoryService;

    /**
     * __construct
     *
     * @param ProductCategoryService $productCategoryService - callback object
     */
    public function __construct(
        ProductCategoryService $productCategoryService
    ) {
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * Get list product's category in admin management
     *
     * @param Request $request - call request send to function
     * 
     * @return view product's category list
     */
    public function index(Request $request)
    {
        $categories = $this->productCategoryService->getProductCategoryList();
        return view('backend.category.index', compact('categories'));
    }


    public function create()
    {
        $parentCategories = $this->productCategoryService->getHierarchyMenu();
        $categories = $this->productCategoryService->getProductCategoryList();
        return view('backend.category.create', compact('parentCategories', 'categories'));
    }

    /**
     * Store information product category
     * 
     * @param ProductCategoryCreate $request - call request send to function
     * 
     * @return \Illuminate\Http\Response list product category
     */
    public function store(ProductCategoryCreate $request)
    {
        $response = $this->productCategoryService->storeProductCategory($request);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.categories.index')->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Get view edit product category in admin management
     * 
     * @param Request $request  - call request send to function
     * @param int     $category - category detail
     * 
     * @return \Illuminate\Http\Response edit product's category
     */
    public function edit(Request $request, $category)
    {
        $parentCategories = $this->productCategoryService->getHierarchyMenu();
        $categories = $this->productCategoryService->getProductCategoryList();
        $productCategory = $this->productCategoryService->getInformationCategory($category);
        return view('backend.category.edit', compact('parentCategories', 'productCategory', 'categories'));
    }

    /**
     * Update information product category
     * 
     * @param Request $request  - call request send to function
     * @param int     $category - category detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryUpdate $request, $category)
    {
        $response = $this->productCategoryService->updateProductCategory($request, $category);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.categories.edit', $category)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information product category
     * 
     * @param int $category - category detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($category)
    {
        $response = $this->productCategoryService->deleteProductCategory($category);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }

    /**
     * Sortable product category
     * 
     * @param \Illuminate\Http\Request $request - request information
     * 
     * @return \Illuminate\Http\Response
     */
    public function sortable(Request $request)
    {
        $this->productCategoryService->sortable($request);
        return response()->json(['success']);
    }
}
