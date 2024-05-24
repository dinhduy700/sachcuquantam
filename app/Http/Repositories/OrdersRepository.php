<?php

/**
 * Order Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Order
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Orders;
use App\Models\ProductReview;
use App\Models\OrderDetail;
use App\Models\Cusomter;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

/**
 * Order Repositories handle query for module Order
 *
 * @category Order
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class OrdersRepository
{
    /**
     * Query get list Order
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination, $search, $start_date, $end_date, $customer, $status, $orderby ="DESC")
    {   
        $orders = Orders::select('orders.*');
        if (!empty($search)) {
            $orders = $orders->where(function($q) use ($search) {
                $q->where('order_code','like', '%'.$search.'%')
                ->orWhere('buyer_name','like', '%'.$search.'%')
                ->orWhere('buyer_phone','like', '%'.$search .'%');
            });
            // $orders = $orders->whereHas(
            //     'translation', function ($query) use ($search) {
            //         $query->where('product_name', 'like', '%'.$search.'%');
            //     }
            // );
        }
        if ($start_date != null) {
            $orders = $orders->whereDate('orders.created_at','>=' ,$start_date);
        }
        if ($end_date != null) {
            $orders = $orders->whereDate('orders.created_at','<=' ,$end_date);
        }
        if ($customer != null) {
            $orders = $orders->where('customer_id', $customer);
        }
        if (!is_null($status) && $status >= -1) {
            $orders = $orders->where('order_status', $status);
        }
        $orders = $orders->with('customter');
        $orders = $orders->orderBy('id', $orderby);
        if (!empty($pagination)) {
            $orders = $orders->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $orders = $orders->get();
        }
        return $orders;
    }

    /**
     * Query get list product review
     * 
     * @param int $limit
     *
     * @return \Illuminate\Http\Response
     */
    public function getListReview($limit,$orderby="DESC")
    {   
        $review = ProductReview::select('product_review.*');
        $review = $review->with('product');
        $review = $review->orderBy('product_review.created_at',$orderby);
        $review = $review->limit(6);
        $review = $review->get();
        return $review;
    }

    /**
     * Query get list product review
     * 
     * @param int $limit
     *
     * @return \Illuminate\Http\Response
     */
    public function getListProductBestSeller($limit,$orderby="DESC")
    {   
        $bestSeller = OrderDetail::select('order_detail.product_id',DB::raw("(SUM(ox_order_detail.quantity)) as quantity"),'product_translation.product_name')
                                ->join('product_translation','product_translation.product_id','=','order_detail.product_id')
                                ->where('product_translation.locale','vi')
                                ->groupBy('order_detail.product_id','product_translation.product_name')
                                ->orderBy(DB::raw("SUM(ox_order_detail.quantity)"),'desc')
                                ->limit(6)
                                ->get();
        return $bestSeller;
    }

    /**
     * Save information product
     *
     * @param Request $request - send information product
     *
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $data = [
            'product_code' => $request->product_code ?? 0,
            'price' => $request->price ?? 0,
            'promotion_price' => $request->promotion_price ?? 0,
            'promotion_start' => Carbon::parse($request->promotion_start)->format('Y-m-d H:i') ?? null,
            'promotion_end' => Carbon::parse($request->promotion_end)->format('Y-m-d H:i') ?? null,
            'is_new' => $request->is_new ?? null,
            'is_highlight' => $request->is_highlight ?? null,
            'is_promotion' => $request->is_promotion ?? null,
            'is_selling' => $request->is_selling ?? null,
            'is_favorite' => $request->is_favorite ?? null,
            'product_category_id' => $request->product_category_id ?? null,
            'brand_id' => $request->brand_id ?? null,
            'is_active' => $request->is_active ?? 0,
            'product_image' => $request->product_image ?? 0,
            'product_slides' => json_encode(array_filter($request->slide)) ?? 0
        ];

        $product = Product::create($data);
    
        if ($product) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation[] = [
                    'locale' => $lang,
                    'product_id' => $product->id,
                    'product_slug' => $request->$lang['product_slug'] ?? Str::slug($request->$lang['product_slug']) . '-' . $product->id,
                    'product_name' => $request->$lang['product_name'] ?? null,
                    'product_description' => $request->$lang['product_description'] ?? null,
                    'product_content'  => $request->$lang['product_content'] ?? null,
                    'seo_title' => $request->$lang['seo_title'] ?? null,
                    'seo_description' => $request->$lang['seo_description'] ?? null,
                    'seo_keywords' => $request->$lang['seo_keywords'] ?? null
                ];
            }
            ProductTranslation::insert($dataTranslation);
        }
    }

    /**
     * Update information order
     * 
     * @param Request            $request - send information order
     * @param \App\Models\Product $order  - order
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $order)
    {
        $data = [
            'buyer_note' => $request->buyer_note,
            'order_status' => $request->order_status ?? 0,
        ];
        return $update = Orders::where('id', $order)->update($data);
    }

    /**
     * get information order
     * 
     * @param $order - order get
     * 
     * @return \Illuminate\Http\Response 
     */
    public function getOrder($order)
    {
        return Orders::with('customter')
                      ->findOrFail($order);
    }

    /**
     * Delete information product
     * 
     * @param $product - product delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete($product)
    {
        Product::find($product)->delete();
    }
}