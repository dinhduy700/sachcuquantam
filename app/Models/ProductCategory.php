<?php

/**
 * Model Product Category Application
 * PHP version ^7.3|^8.0
 *
 * @category Product_Category
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;

/**
 * Class ProductCategory
 * PHP version ^7.3|^8.0
 *
 * @category Product_Category
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_categories';

    protected $fillable = [
        'image', 'parent_id', 'position', 'is_active', 'is_top'
    ];

    public $categories = [];

    /**
     * Get the locale for the product category.
     *
     * @return void
     */
    public function translation()
    {
        return $this->hasOne(ProductCategoryTranslation::class, 'product_category_id')->where('locale', config('app.locale'));
    }

    /**
     * Get the locale for the product category.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(ProductCategoryTranslation::class, 'product_category_id');
    }

    /**
     * Recursive child category
     *
     * @return void
     */
    public function child()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id')->orderBy('position', 'ASC')->with('translation');
    }

    /**
     * Recursive active child category
     *
     * @return void
     */
    public function activeChild()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id')->where('is_active', 1)->with('translation');
    }

    /**
     * Add recursive child category to parent tree
     *
     * @return void
     */
    public static function tree()
    {
        return static::with(
            implode('.', array_fill(0, 100, 'child'))
        )->with('translation')->whereNull('parent_id')->orderBy('position', 'ASC')->get();
    }

    /**
     * Get hierarchy menu
     *
     * @return void
     */
    public static function getHierarchy()
    {
        return (new self())->_getCategories();
    }

    /**
     * Get active hierarchy menu
     *
     * @return void
     */
    public static function getActiveHierarchy()
    {
        return (new self())->_getActiveCategories();
    }

    /**
     * Get hierarchy menu categories
     *
     * @return void
     */
    private function _getCategories()
    {
        $mainCategories = static::with(
            implode('.', array_fill(0, 100, 'child'))
        )->with('translation')->whereNull('parent_id')->orderBy('position', 'ASC')->get();

        foreach ($mainCategories as $category) {
            $this->categories[] = $category;
            $this->_getParentCategories($category, 0);
        }

        return $this->categories;
    }
    
    public function product() {
        return $this->hasMany(Product::class,'product_category_id');
    }

    /**
     * Get active hierarchy menu categories
     *
     * @return void
     */
    private function _getActiveCategories()
    {
        $mainCategories = static::with(
            implode('.', array_fill(0, 100, 'activeChild'))
        )->with('translation')->where('is_active', 1)->whereNull('parent_id')->orderBy('position', 'ASC')->get();
        foreach ($mainCategories as $category) {
            $this->categories[] = $category;
            $this->_getActiveParentCategories($category, 0);
        }
        return $this->categories;
    }

    /**
     * Get hierarchy menu parent categories
     *
     * @param ProductCategory $category - call request send to function
     * @param ProductCategory $level    - level menu hierarchy
     *
     * @return void
     */
    private function _getActiveParentCategories($category, $level)
    {
        if ($category->child) {
            $level++;
            foreach ($category->activeChild as $subCategory) {
                $subCategory->translation->product_category_name = str_repeat('- ', $level) . $subCategory->translation->product_category_name;
                $this->categories[] = $subCategory;
                $this->_getActiveParentCategories($subCategory, $level);
            }
        }
    }

    /**
     * Get hierarchy menu parent categories
     *
     * @param ProductCategory $category - call request send to function
     * @param ProductCategory $level    - level menu hierarchy
     *
     * @return void
     */
    private function _getParentCategories($category, $level)
    {
        if ($category->child) {
            $level++;
            foreach ($category->child as $subCategory) {
                $subCategory->translation->product_category_name = str_repeat('- ', $level) . $subCategory->translation->product_category_name;
                $this->categories[] = $subCategory;
                $this->_getParentCategories($subCategory, $level);
            }
        }
    }
}
