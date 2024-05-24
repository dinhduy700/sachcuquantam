<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryTranslation extends Model
{
    use HasFactory;

    protected $table = 'product_category_translation';

    protected $fillable = [
        'locale',
        'product_category_id',
        'product_category_name',
        'product_category_slug',
        'product_category_description',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    /**
     * Get the product category that owns the locale.
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function product() {
        return $this->hasMany(Product::class,'product_category_id');
    }
}
