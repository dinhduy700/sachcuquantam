<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'quantity',
        'amount'
    ];

    /**
     * Get mapping information by product for the orders.
     *
     * @return void
     */
    public function productTranslation()
    {
        return $this->belongsTo(ProductTranslation::class,'product_id','product_id')->where('locale', config('app.locale'));
    }

    /**
     * Get mapping information by product for the orders.
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
