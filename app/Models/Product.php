<?php

/**
 * Model Product Application
 * PHP version ^7.3|^8.0
 *
 * @category Product
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * PHP version ^7.3|^8.0
 *
 * @category Product
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'product_category_id',
        'brand_id',
        'product_image',
        'product_slides',
        'product_code',
        'price',
        'promotion_price',
        'promotion_start',
        'promotion_end',
        'product_position',
        'is_active',
        'is_new',
        'is_highlight',
        'is_promotion',
        'is_selling',
        'is_favorite'
    ];
    public $products = [];

    /**
     * Get the locale for the product translation.
     *
     * @return void
     */
    public function translation()
    {
        return $this->hasOne(ProductTranslation::class, 'product_id')->where('locale', config('app.locale'));
    }

    /**
     * Get the product translation.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id');
    }

    /**
     *  Get the product category.
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }
    
    /**
     *  Get the product category translation.
     *
     * @return void
     */
    public function categoryTranslation()
    {
        return $this->belongsTo(ProductCategoryTranslation::class,'product_category_id','product_category_id')->where('locale', config('app.locale'));
    }

    /**
     *  Get the brand.
     *
     * @return void
     */
    public function brand()
    {
        return $this->belongsTo(Brands::class,'brand_id');
    }
    
    /**
     * get list product with relation
     *
     * @return void
     */
    public static function get($pagination)
    {
        return static::with('translation')
               ->with('category')
               ->with('brand')
               ->with('categoryTranslation')
               ->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
    }

    /**
     * Get the order detail that owns.
     *
     * @return void
     */
    public function orderDetail() {
        return $this->hasMany(OrderDetail::class,'product_id');
    }
}
