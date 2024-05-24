<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class Cart extends Model
{
    use HasFactory;

    public function addProductToCart($product, $numberProduct, $key = array())
    {
    	$dataCart = array();
    	if(!Session::has('cart'))
        {
        	$dataCart['totalNumber'] = $numberProduct;
            $dataCart['data'] = array();
            $dataCart['data']['product_'. $product->id] = array();
            $dataCart['data']['product_'. $product->id]['totalProduct'] = $numberProduct;
            $dataCart['data']['product_'. $product->id]['info'] = $product;
        }
        else
        {
        	$dataCart = Session::get('cart');
        	if(isset($dataCart['data']['product_'. $product->id]['totalProduct']))
            {
                $dataCart['data']['product_'. $product->id]['totalProduct'] = $dataCart['data']['product_'. $product->id]['totalProduct'] + $numberProduct;
            }
            else
            {
                $dataCart['data']['product_'. $product->id] = array();
                $dataCart['data']['product_'. $product->id]['totalProduct'] = $numberProduct;
                $dataCart['data']['product_'. $product->id]['info'] = $product;
            }
            $dataCart['data']['product_'. $product->id]['info'] = $product;
            $dataCart['totalNumber'] = $dataCart['totalNumber'] + $numberProduct;
        }
        Session::put('cart', $dataCart);
        return Session::get('cart');
    }
    public function updateProductToCart($product, $numberProduct, $key = array())
    {
        $dataCart = Session::get('cart');
        if(isset($dataCart['data']['product_'. $product->id]['totalProduct']))
        {
            $numberChange = $numberProduct - $dataCart['data']['product_'. $product->id]['totalProduct'] ;
            $dataCart['data']['product_'. $product->id]['totalProduct'] = $numberProduct;
        }
        $dataCart['data']['product_'. $product->id]['info'] = $product;
        $dataCart['totalNumber'] = $dataCart['totalNumber'] + $numberChange;
        Session::put('cart', $dataCart);
        return Session::get('cart');
    }

    public function removeProductToCart($product = null)
    {
        $dataCart = Session::get('cart');
        if(isset($dataCart['data']['product_'. $product->id]))
        {
            $dataCart['totalNumber'] = $dataCart['totalNumber'] - $dataCart['data']['product_'. $product->id]['totalProduct'];
            unset($dataCart['data']['product_'. $product->id]);
        }
        Session::put('cart', $dataCart);
        if($dataCart['totalNumber'] == 0)
        {
            Session::forget('cart');
        }
        return Session::get('cart');
    }
}
