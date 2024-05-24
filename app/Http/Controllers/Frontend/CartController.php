<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Http\Response;
use App\Http\Services\ProductService;
use DB;
use Session;
use App\Events\SendMail;
use Event;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\NotificationManagement;
use Pusher\Pusher;
use Carbon\Carbon;
use Auth;

class CartController extends Controller
{
	public function __construct(Cart $cart, ProductService $productService)
	{
        $this->cart = $cart;
        $this->productService = $productService;
	}

	/**
	 * Add Product To Cart
	 * @param $product_id, $number_product
	 *
	 * @return $cart
	**/
    public function addToCart(Request $rq)
    {
    	if($rq->ajax())
        {
        	//$productId = $rq->product_id ? $rq->product_id : 1;
            if(!$rq->product_id)
                return json_encode(['message' => 'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            else
                $productId = $rq->product_id;
            $product = $this->productService->getProductById($productId);
            if(empty($product))
                return json_encode(['message' => 'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            $numberProduct = $rq->number_product ? $rq->number_product : 1;
            $cart = $this->cart->addProductToCart($product, $numberProduct, null);
            return view('frontend.layouts.header-cart');
        }
        else
        {
        	return json_encode(['message'=>'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR ]);
        }
    }

    public function updateToCart(Request $rq)
    {
        if($rq->ajax())
        {
            
            if(!$rq->product_id)
                return json_encode(['message' => 'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            else
                $productId = $rq->product_id;
            $product = $this->productService->getProductById($productId);
            if(empty($product))
                return json_encode(['message' => 'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            $numberProduct = $rq->number_product ? $rq->number_product : 1;
            $cart = $this->cart->updateProductToCart($product, $numberProduct, null);
            return view('frontend.layouts.header-cart');
        }
        else
        {
            return json_encode(['message'=>'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR ]);
        }
    }

    public function removeToCart(Request $rq)
    {
        if($rq->ajax())
        {
            
            if(!$rq->product_id)
                return json_encode(['message' => 'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            else
                $productId = $rq->product_id;
            $product = $this->productService->getProductById($productId);
            if(empty($product))
                return json_encode(['message' => 'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR]);
            $cart = $this->cart->removeProductToCart($product);
            return view('frontend.layouts.header-cart');
        }
        else
        {
            return json_encode(['message'=>'Thất bại', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR ]);
        }
    }

    public function postOrder(Request $rq)
    {
        DB::beginTransaction();
        try{
            $dataCart = Session::get('cart');
            if(empty($dataCart))
                return redirect()->route('home');
            $totalPrice = 0;
            if(!empty($dataCart['data']))
            foreach ($dataCart['data'] as $key => $value) {
                $product = $this->productService->getProductById($value['info']->id);
                $dataCart['data'][$key]['info'] = $product;
                $price = 0;
                $time = date('Y-m-d');
                if($product->promotion_price != null)
                    if( $time >= $product->promotion_start && $time <= $product->promotion_end)
                        $price = $product->promotion_price;
                    else
                    $price = $product->price;
                else
                {
                    $price = $product->price;
                }
                $totalPrice = $totalPrice + $price * $value['totalProduct'];
            }
            Session::put('cart', $dataCart);
            $dataCart = Session::get('cart');
            $data = array();
            $data['customer_id'] = isset(Auth()->guard('customer')->user()->id) ? Auth()->guard('customer')->user()->id : null;
            $data['order_code'] = date('Ymd').time();
            $data['buyer_name'] = $rq->buyer_name;
            $data['buyer_phone'] = $rq->buyer_phone;
            $data['buyer_city'] = $rq->buyer_city;
            $data['buyer_district'] = $rq->buyer_district;
            $data['buyer_ward'] = $rq->buyer_ward;
            $data['buyer_note'] = $rq->buyer_note;
            $data['order_shipping_fee'] = 30000;
            $data['order_amount'] = $totalPrice;
            $data['order_discount'] = 0;
            $data['total_amount'] = $totalPrice + 30000;
            $data['payment_method'] = $rq->payment_method;
            $data['shipping_method'] = $rq->shipping_method;
            $data['order_status'] = 0;
            $data['order_address'] = $rq->order_address;
            $data['order_email'] = $rq->order_email;
            $data['created_at'] = Carbon::now();
            $idOrder = DB::table('orders')->insertGetId($data);
            foreach ($dataCart['data'] as $key => $value) {
                $price = 0;
                $time = date('Y-m-d');
                if($value['info']->promotion_price != null)
                    if( $time >= $value['info']->promotion_start && $time <= $value['info']->promotion_end)
                        $price = $value['info']->promotion_price;
                    else
                    $price = $value['info']->price;
                else
                {
                    $price = $value['info']->price;
                }
                DB::table('order_detail')->insert([
                    'product_id' => $value['info']->id,
                    'order_id' => $idOrder,
                    'price' => $price,
                    'quantity' => $value['totalProduct'],
                    'amount' => $price * $value['totalProduct']
                ]);
            }
            DB::commit();
            $users = User::where(['type' => 0, 'is_active' => 1])->get();

            $notify = [
                'id' => $idOrder,
                'title' => trans('app.cart.new_order', ['order' => $idOrder]),
                'user' => $rq->buyer_name.' - '.$rq->buyer_phone,
                'type' => 1
            ];
            Notification::send($users, new NotificationManagement($notify));

            $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $pusher->trigger('Notify', 'notify-channel', $notify);
            Event(new SendMail($dataCart, $data));
            Session::forget('cart');
            if(Auth::guard('customer')->check())
            {
                return redirect()->route('info-customter')->with('success', 'Đăng ký đơn hàng thành công');
            }
            // return redirect()->route('home')->with('success', 'Đăng ký đơn hàng thành công')
            return redirect()->route('confirm')->with('data', $data)->with('dataCart', $dataCart);
            
        }
        catch(Exception $e)
        {
            DB::callback();
            abort(500);
        }
    }
}
