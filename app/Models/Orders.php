<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'buyer_name',
        'buyer_phone',
        'buyer_country',
        'buyer_city',
        'buyer_district',
        'buyer_ward',
        'buyer_zipcode',
        'buyer_note',
        'order_code',
        'order_promotion_code',
        'order_amount',
        'order_shipping_fee',
        'order_discount',
        'total_amount',
        'payment_method',
        'shipping_method',
        'order_status'
    ];

    /**
     * Get mapping information by customter for the orders.
     *
     * @return void
     */
    public function customter()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getFormatCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
    }

    public function getAddressBuyerFormatAttribute()
    {
        $address = '';
        $address .= !empty($this->attributes['order_address']) ? $this->attributes['order_address'].', ' : null;
        $address .= !empty($this->attributes['buyer_ward']) ? $this->attributes['buyer_ward'].', ' : null;
        $address .= !empty($this->attributes['buyer_district']) ? $this->attributes['buyer_district'].', ' : null;
        $address .= $this->attributes['buyer_city'];
        return $address;
    }

    public function detaiOrder()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
