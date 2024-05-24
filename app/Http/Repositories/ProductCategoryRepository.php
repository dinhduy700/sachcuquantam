<?php

/**
 * Product Category Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Product
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\ProductCategory;

use App\Models\Product;

use App\Models\ProductCategoryTranslation;

use Illuminate\Support\Str;

use DB;

/**
 * Product Category Repositories handle query for module Product
 *
 * @category Product
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class ProductCategoryRepository
{
    /**
     * Query get list product's category by status
     *
     * @return \Illuminate\Http\Response $categories
     */
    public function getProductCategoryTree()
    {
        $categories = ProductCategory::tree();
        return $categories;
    }

    /**
     * Query get full list
     *
     * @return \Illuminate\Http\Response $categories
     */
    public function getList($parent_id)
    {
        $categories = ProductCategory::select('*',DB::raw('(select count(*) from ox_product_categories chld where chld.parent_id = ox_product_categories.id group by chld.parent_id limit 1) as child_num'));
        if ($parent_id > -1) {
            if($parent_id == 0) $parent_id = null;
            $categories = $categories->where('parent_id', $parent_id);
        }
        
        $categories = $categories->with('translation')->get();
        return $categories;
    }

    /**
     * Query get hierarchy product category
     *
     * @return \Illuminate\Http\Response $categories
     */
    public function getHierarchy()
    {
        $categories = ProductCategory::getHierarchy();
        return $categories;
    }

    /**
     * Query get active hierarchy product category
     *
     * @return \Illuminate\Http\Response  $categories
     */
    public function getActiveHierarchy()
    {
        $categories = ProductCategory::getActiveHierarchy();
        return $categories;
    }

    /**
     * Save information product category
     *
     * @param Request $request - send information product category
     *
     * @return \Illuminate\Http\Response
     */
    public function storeProductCategoryInformation($request)
    {
        $data = [
            'image' => $request->image ?? null,
            'parent_id' => $request->parent_id ?? null,
            'is_active' => $request->is_active ?? 0,
            'is_top' => $request->is_top ?? 0
        ];
        $category = ProductCategory::create($data);
        if ($category) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation[] = [
                    'locale' => $lang,
                    'product_category_id' => $category->id,
                    'product_category_name' => $request->$lang['product_category_name'],
                    'product_category_slug' => $request->$lang['product_category_slug'] ?? Str::slug($request->$lang['product_category_name']) . '-' . $category->id,
                    'product_category_description' => $request->$lang['product_category_description'] ?? null,
                    'seo_title' => $request->$lang['seo_title'] ?? null,
                    'seo_description' => $request->$lang['seo_description'] ?? null,
                    'seo_keywords' => $request->$lang['seo_keywords'] ?? null,
                ];
            }
            $category = ProductCategoryTranslation::insert($dataTranslation);
        }
    }

    /**
     * Update information product category
     * 
     * @param Request $request         - send information product category 
     * @param int     $productCategory - product category 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function updateProductCategoryInformation($request, $productCategory)
    {
        $data = [
            'image' => $request->image ?? null,
            'parent_id' => $request->parent_id ?? null,
            'is_active' => $request->is_active ?? 0,
            'is_top' => $request->is_top ?? 0
        ];
        $category = ProductCategory::where('id', $productCategory)->update($data);
        if ($category) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation = [
                    'product_category_name' => $request->$lang['product_category_name'],
                    'product_category_slug' => $request->$lang['product_category_slug'] ?? Str::slug($request->$lang['product_category_name']) . '-' . $productCategory,
                    'product_category_description' => $request->$lang['product_category_description'] ?? null,
                    'seo_title' => $request->$lang['seo_title'] ?? null,
                    'seo_description' => $request->$lang['seo_description'] ?? null,
                    'seo_keywords' => $request->$lang['seo_keywords'] ?? null,
                ];
                $category = ProductCategoryTranslation::where(['locale' => $lang, 'product_category_id' => $productCategory])->update($dataTranslation);
            }
        }
    }

    /**
     * Delete information product category
     * 
     * @param $category - category detail delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function deleteProductCategoryInformation($category)
    {
        Product::where('product_category_id', $category)->update(['product_category_id' => null]);
        ProductCategory::where('parent_id', $category)->update(['parent_id' => null]);
        ProductCategory::find($category)->delete();
    }

    /**
     * Get information product category
     * 
     * @param ProductCategory $category - category detail
     * 
     * @return \Illuminate\Http\Response $productCategory
     */
    public function getInformationCategory($category)
    {
        return ProductCategory::findOrFail($category);
    }

    /**
     * Get information product category
     * 
     * @param \Illuminate\Http\Request $request - send information product category
     * 
     * @return \Illuminate\Http\Response $productCategory
     */
    public function sortable($request)
    {
        if (!empty($request->all())) {
            foreach ($request->all() as $data) {
                $productCategory = ProductCategory::findOrFail($data['category']);
                $productCategory->parent_id = $data['parent'];
                $productCategory->position  = $data['position'];
                $productCategory->save();
            } 
        }
    }

    public function getProductCategoryBySlug($slug)
    {
        return ProductCategory::whereHas('translation', function($query) use ($slug){
            $query->where('product_category_slug', $slug);
        })->first();
    }

    public function getListCategoryTop()
    {
        return ProductCategory::where('is_top', 1)->get();
    }
}