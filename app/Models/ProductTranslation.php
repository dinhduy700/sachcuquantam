<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $table = 'product_translation';

    protected $fillable = [
        'locale',
        'product_id',
        'product_name',
        'product_slug',
        'product_description',
        'product_content',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    /**
     * Get the product that owns the locale.
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
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
