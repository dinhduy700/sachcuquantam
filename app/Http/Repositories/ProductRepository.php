<?php

/**
 * Product Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Product
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * Product Repositories handle query for module Product
 *
 * @category Product
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class ProductRepository
{
    /**
     * Query get list Product
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination, $search, $category, $brand,$orderby= "DESC")
    {   
        $product = Product::select('products.*');
        if (!empty($search)) {
            $product = $product->whereHas(
                'translation', function ($query) use ($search) {
                    $query->where('product_name', 'like', '%'.$search.'%');
                }
            );
        }
        if ($category != null) {
            $product = $product->where('product_category_id', $category);
        }
        if ($brand != null) {
            $product = $product->where('brand_id', $brand);
        }
        $product = $product->with('translation')
                           ->with('category')
                           ->with('brand')
                           ->with('categoryTranslation');
        $product = $product->orderBy('products.created_at',$orderby);                   
        if (!empty($pagination)) {
            $product = $product->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $product = $product->get();
        }
        return $product;
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
            'promotion_start' => !empty($request->promotion_start) ? Carbon::parse($request->promotion_start)->format('Y-m-d H:i') : null,
            'promotion_end' => !empty($request->promotion_start) ? Carbon::parse($request->promotion_end)->format('Y-m-d H:i') : null,
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
                    'product_slug' => $request->$lang['product_slug'] ?? Str::slug($request->$lang['product_name']) . '-' . $product->id,
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
        return $product;
    }

    /**
     * Update information product
     * 
     * @param Request            $request - send information product
     * @param \App\Models\Product $product  - product
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $product)
    {
        $data = [
            'product_code' => $request->product_code ?? 0,
            'price' => $request->price ?? 0,
            'promotion_price' => $request->promotion_price ?? 0,
            'promotion_start' => !empty($request->promotion_start) ? Carbon::parse($request->promotion_start)->format('Y-m-d H:i') : null,
            'promotion_end' => !empty($request->promotion_start) ? Carbon::parse($request->promotion_end)->format('Y-m-d H:i') : null,
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
        Product::where('id', $product)->update($data);
        if ($product) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation = [
                    'locale' => $lang,
                    'product_id' => $product,
                    'product_slug' => $request->$lang['product_slug'] ?? Str::slug($request->$lang['product_name']) . '-' . $product,
                    'product_name' => $request->$lang['product_name'] ?? null,
                    'product_description' => $request->$lang['product_description'] ?? null,
                    'product_content'  => $request->$lang['product_content'] ?? null,
                    'seo_title' => $request->$lang['seo_title'] ?? null,
                    'seo_description' => $request->$lang['seo_description'] ?? null,
                    'seo_keywords' => $request->$lang['seo_keywords'] ?? null
                ];
                ProductTranslation::where(['locale' => $lang, 'product_id' => $product])->update($dataTranslation);
            }
        }
    }

    public function getInformationProduct($product)
    {
        return Product::with('translations')
                      ->with('brand')
                      ->with('categoryTranslation')
                      ->findOrFail($product);
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

    public function getProductListPage($paginate, $type, $rq, $category)
    {
        if($type == 0)
        {
            $productList = Product::with('translation')->orderBy('id', 'DESC');
        }
        if($type == 1)
        {
            $productList = Product::with('translation')->orderBy('id', 'DESC')->where('is_new', 1);
        }
        if($type == 2)
        {
            $productList = Product::with('translation')->orderBy('id', 'DESC')->where('is_promotion', 1);
        }
        if($type == 3)
        {
            $productList = Product::with('translation')->orderBy('id', 'DESC')->where('is_highlight', 1);
        }
        if($type == 4)
        {
            $productList = Product::with('translation')->orderBy('id', 'DESC')->where('is_selling', 1);
        }
        if($type == 5)
        {
            $productList = Product::with('translation')->orderBy('id', 'DESC')->where('is_favorite', 1);
        }
        if($rq != null)
        {
            if($rq->min)
            {
                $min = preg_replace("/[^0-9]/", "", $rq->min);
                $productList = $productList->where(function($query) use ($min){
                    // $query -> where('price', '>=', $min)
                    // ->orWhere('promotion_price', '>=', $min);
                    $query->where( function ($query) use ($min){
                        $time = date('Y-m-d');
                        $query->where('promotion_price', '>=', $min)
                        ->where('promotion_start', '<=', $time)
                        ->where('promotion_end', '>=', $time);
                    })->orWhere( function ($query) use ($min){
                        $query->where('price', '>=', $min);
                    });
                });
            }
            if($rq->max)
            {
                $max = preg_replace("/[^0-9]/", "", $rq->max);
                $productList = $productList->where(function($query) use ($max){
                    // $query -> where('price', '<=', $max)
                    // ->orWhere('promotion_price', '<=', $max);
                    $query->where( function ($query) use ($max){
                        $time = date('Y-m-d');
                        $query->where('promotion_price', '<=', $max)
                        ->where('promotion_start', '<=', $time)
                        ->where('promotion_end', '>=', $time);
                    })->orWhere( function ($query) use ($max){
                        $query->where('price', '<=', $max);
                    });
                });
            }
            if(!empty($rq->brand))
            {
                $productList = $productList->whereIn('brand_id', $rq->brand);
            }
        }
        if($category)
        {
            $productList = $productList->where('product_category_id', $category);
        }
        $productList = $productList->paginate($paginate);
        return $productList;
    }

    public function getProductBySLug($slug)
    {
        return Product::with('translation')->whereHas('translation', function($query) use($slug){
            $query->where('product_slug', $slug);
        })->first();
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }
}