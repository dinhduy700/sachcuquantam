<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use App\Http\Services\OrderDetailService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class OrderController extends Controller {
  protected $orderService;
  public function __construct(OrderService $orderService,OrderDetailService $orderDetailService) {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
  }

  /**
  * Function: index
  * show order list
  *
  * @param request
  * @return View
  * @access public
  */
  public function index(Request $request) {
    $pagination     = $request->get('items') ?? config('constants.pagination');
    $search         = $request->get('search');
    $order_date     = $request->get('order_date');
    $order_status   = $request->get('order_status');
    $start_date     = null;
    $end_date       = null;
    if($order_date){
      $order_date   = explode('-',$order_date);
      $start_date   = date('Y-m-d',strtotime($order_date[0]));
      $end_date     = date('Y-m-d',strtotime($order_date[1]));
    }
    $cusomter       = $request->get('cusomter');
    $listOrders     = $this->orderService->getList($pagination,$search, $start_date, $end_date,$cusomter,$order_status);
    $data['orders'] = $listOrders;
    return view('backend.order.index', $data);
  }

  public function create() {
    return view('backend.order.create', []);
  }

  /**
  * Function: edit
  * get order and order detail 
  *
  * @param request
  * @return View
  * @access public
  */
  public function edit(Request $request,$order) {
    $data['order'] =$this->orderService->get($order);
    $data['detail'] =$this->orderDetailService->get($order);
    return view('backend.order.edit', $data);
  }

  /**
  * Function: update
  * update information order
  *
  * @param request
  * @return order
  * @access public
  */
  public function update(Request $request,$order) {
    $response = $this->orderService->updateOrder($request,$order);
    return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.orders.edit', $order)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
  }


}
