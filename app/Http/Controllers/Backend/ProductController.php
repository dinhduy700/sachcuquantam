<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Services\ProductCategoryService;
use App\Http\Services\ProductService;
use App\Http\Requests\Backend\ProductCreate;
use App\Http\Requests\Backend\ProductUpdate;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Brands;
use DB;
use App\Jobs\SendSubscribeEmail;

class ProductController extends Controller {
  protected $productCategoryService;
  protected $productService;
  public function __construct(ProductCategoryService $productCategoryService,ProductService $productService) {
        $this->productCategoryService = $productCategoryService;
        $this->productService         = $productService;
  }

  /**
  * Function: index
  * show product list
  *
  * @param request
  * @return View
  * @access public
  */
  public function index(Request $request) {
    $pagination = $request->get('items') ?? config('constants.pagination');
    $search = $request->get('search');
    $category = $request->get('category');
    $brand = $request->get('brand');
    $parent_id = null;
    $listProducts = $this->productService->getProductList($pagination,$search, $category, $brand);
    $data['brands'] = Brands::get();
    $data['categories'] = $this->productCategoryService->getList($parent_id);
    $data['listProducts'] =$listProducts;
    return view('backend.product.index', $data);
  }
  
 /**
  * Function: create
  * add new product
  *
  * @param request
  * @return View
  * @access public
  */
  public function create() {
    $categories = $this->productCategoryService->getList(0);
    // tạm thời
    $brands = Brands::get();
    $data['categories'] = $categories;
    $data['brands'] = $brands;
    return view('backend.product.create', $data);
  }

  /**
  * Function: edit
  * edit product
  *
  * @param request
  * @return View
  * @access public
  */
  public function edit(Request $request, $product_id) {
    $parent_id = null;
    // tạm thời
    $brands = Brands::get();
    $data['categories'] = $this->productCategoryService->getList($parent_id);
    $data['product'] = $this->productService->getInformationProduct($product_id);
    $data['brands'] = $brands;
    return view('backend.product.edit', $data);
  }

  /**
  * Function: getCategory
  * get category
  *
  * @param request
  * @return View
  * @access public
  */
  public function getCategory(Request $request) {
    $parent_id = $request->get('parent_id');
    $categories = $this->productCategoryService->getList($parent_id);
    return response()->json([
      'status' => true,
      'data' => $categories,
      'status_code' => 200,
      'message' =>"Get list successfull!",
  ]);
  }

 /**
  * Function: store
  * Store information product
  *
  * @param request
  * @return Response list product
  * @access public
  */
  public function store(ProductCreate $request)
  {
    $response = $this->productService->storeProduct($request);
    if (!empty($response['id']) && !empty($response['active'])) {
      dispatch(new SendSubscribeEmail($response['id'], 1));
  }
    return $response['status'] === Response::HTTP_OK ?
      redirect()->route('admin.products.index')->with('success', $response['message']) :
      redirect()->back()->withInput($request->all())->with('error', $response['message']);
  }

  /**
  * Function: update
  * Update information product
  *
  * @param request
  * @return Response list product
  * @access public
  */
  public function update(ProductUpdate $request,$product)
  {
    $response = $this->productService->updateProduct($request,$product);
    return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.products.edit', $product)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
  }

  /**
  * Function: delete
  * delete product
  *
  * @param request
  * @return Response
  * @access public
  */
  public function delete($product) {
    $response = $this->productService->deleteProduct($product);
    return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
  }
}
