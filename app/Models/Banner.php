<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'banners';

    protected $fillable = [
        'banner_page',
        'banner_position',
        'is_active',
        'has_button',
        'type'
    ];

    /**
     * Get mapping information by locale for the banner.
     *
     * @return void
     */
    public function translation()
    {
        return $this->hasOne(BannerTranslation::class, 'banner_id')->where('locale', config('app.locale'));
    }

    /**
     * Get the locale for the product category.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(BannerTranslation::class, 'banner_id');
    }

    /**
     * Get mapping page information for the banner.
     *
     * @return void
     */
    public function page()
    {
        return $this->hasOne(Page::class, 'id', 'banner_page');
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
    }

    public function getBannerImageAttribute()
    {
        return !empty($this->translation->banner_image) && File::exists(public_path($this->translation->banner_image)) ? $this->translation->banner_image : config('constants.no_image_url');
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
