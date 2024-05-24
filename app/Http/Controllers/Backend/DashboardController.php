<?php

namespace App\Http\Controllers\Backend;
use App\Http\Services\OrderService;
use App\Http\Services\ProductService;
use App\Http\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller {
  
  protected $orderService;
  protected $productService;
  protected $customerService;
  public function __construct(OrderService $orderService,
                              ProductService $productService,
                              CustomerService $customerService
                              ) {
        $this->orderService         = $orderService;
        $this->productService       = $productService;
        $this->customerService      = $customerService;
  }

  /**
  * Function: index
  * show dashboard
  *
  * @param request
  * @return View
  * @access public
  */
  public function index() {
    $data['countOrder']       = $this->orderService->getList(null,null, null, null,null,2);
    $data['countRevenue']     = 0;
    foreach($data['countOrder'] as $row){
      $data['countRevenue']  +=  $row->total_amount;
    }
    $data['orders']           = $this->orderService->getList(6,null, null, null,null,null);
    $data['countProduct']     = $this->productService->getProductList(null,null, null, null,null);
    $data['countCustomer']    = $this->customerService->getCustomerList(null, null, null);
    $data['comments']         =  $this->orderService->getListReview(6);
    $data['topProducts']      =  $this->orderService->getListProductBestSeller(6);
    // dd($data);
    return view('backend.dashboard.index',$data);
  }
}
