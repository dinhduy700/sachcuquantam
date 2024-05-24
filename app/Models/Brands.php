<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Brands extends Model {

    use HasFactory, SoftDeletes;

    protected $table = 'brands';

    protected $fillable = [
        'brand_name',
        'brand_image',
        'brand_link',
        'brand_position',
        'is_active'
    ];

    public function product() 
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
    }

    /**
     * Scope active
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', config('constants.status.active'));
    }

    /**
     * Scope active
     *
     * @return void
     */
    public function getActiveTextAttribute()
    {
        return !empty($this->is_active) ? __('app.status.active') : __('app.status.inactive');
    }
}
