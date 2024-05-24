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
use App\Models\Cusomter;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * Order Detail Repositories handle query for module Order detail
 *
 * @category OrderDetailRepository
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class OrderDetailRepository
{
    /**
     * Query get list Order order detail
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination,$search, $start_date, $end_date,$cusomter)
    {   
        $orders = Orders::select('orders.*');
        if (!empty($search)) {
            $orders = $orders->whereHas(
                'translation', function ($query) use ($search) {
                    $query->where('product_name', 'like', '%'.$search.'%');
                }
            );
        }
        if ($start_date != null) {
            $orders = $orders->where('product_category_id', $category);
        }
        if ($end_date != null) {
            $orders = $orders->where('brand_id', $brand);
        }
        if ($cusomter != null) {
            $orders = $orders->where('brand_id', $brand);
        }
        $orders = $orders->with('customter');
        if (!empty($pagination)) {
            $orders = $orders->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $orders = $orders->get();
        }
        return $orders;
    }

    /**
     * get order detail
     * 
     * @param $order
     * 
     * @return \Illuminate\Http\Response 
     */
    public function get($order)
    {
        return OrderDetail::with('productTranslation')
                      ->with('product')
                      ->where('order_id', $order)
                      ->get();
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