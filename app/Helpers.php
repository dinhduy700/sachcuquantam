<?php
/**
 * Helpers Application
 * PHP version ^7.3|^8.0
 *
 * @category Helpers
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

if (! function_exists('getLocaleSession')) {
    /**
     * Get locale by session user
     * 
     * @return string
     */
    function getLocaleSession()
    {
        return session()->has('locale') ? session()->get('locale') : config('app.locale');
    }
}

if (! function_exists('getStatusProduct')) {
    /**
     * Get status of product
     * 
     * @return string
     */
    function getStatusProduct($status)
    {
        switch ($status) {
            case 0:
                return "Ẩn";
                break;
            case 1:
                return "Hiện";
                break;
            default:
                return "Ẩn";
                break;
        }
    }
}

if (! function_exists('getStatusOrder')) {
    /**
     * Get status of order
     * 
     * @return string
     */
    function getStatusOrder($status)
    {
        switch ($status) {
            case 0:
                return '<span class="badge badge-pill badge-soft-warning fs-12px">Chờ xác nhận</span>';
                break;
            case 1:
                return  '<span class="badge badge-pill badge-soft-info fs-12px">Đã xác nhận</span>';
                break;
            case 2:
                return '<span class="badge badge-pill badge-soft-success fs-12px">Đã giao</span>';
                break;
            case 3:
                return '<span class="badge badge-pill badge-soft-danger fs-12px">Đã hủy</span>';
                break;      
            default:
                return '<span class="badge badge-pill badge-soft-info fs-12px">Chờ xác nhận</span>';
                break;
        }
    }
}

if (! function_exists('getNamePaymentMethod')) {
    /**
     * get Name Payment Method
     * 
     * @return string
     */
    function getNamePaymentMethod($status)
    {
        switch ($status) {
            case 1:
                return "COD - Thanh toán khi nhận hàng";
                break;
            case 2:
                return "Chuyển khoản ngân hàng";
                break;
            case 3:
                return "Thanh toán tại cửa hàng";
                break;    
            default:
                return "COD - Thanh toán khi nhận hàng";
                break;
        }
    }
}

if(! function_exists('showPricePromotion') )
{
    function showPricePromotion($price, $pricePromotion = null, $startDate = null, $EndDate = null)
    {
        $time = date('Y-m-d');
        if($pricePromotion != null)
            if( $time >= $startDate && $time <= $EndDate)
                return '<span class="product-price">'.number_format($pricePromotion, 0, '', '.'). '₫ </span>'. ' <span class="compare-price">'.number_format($price, 0, '', '.').'₫</span>';
        else
            return '<span class="product-price">'.number_format($price, 0, '', '.'). '₫ <span>';
        return '<span class="product-price">'.number_format($price, 0, '', '.'). '₫ </span>';
    }
}

if(! function_exists('showPricePromotionDetail') )
{
    function showPricePromotionDetail($price, $pricePromotion = null, $startDate = null, $EndDate = null)
    {
        $time = date('Y-m-d');
        if($pricePromotion != null)
            if( $time >= $startDate && $time <= $EndDate)
                return '<span class="price product-price sale-price">' .number_format($pricePromotion, 0, '', '.'). '₫ </span>'. ' <del class="old-price">'.number_format($price, 0, '', '.').'₫</del>';
        else
            return '<span class="price product-price sale-price">'.number_format($price, 0, '', '.'). '₫ </span>';
        return '<span class="price product-price sale-price">'.number_format($price, 0, '', '.'). '₫ </span>';
    }
}
