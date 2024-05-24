<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'tag_id',
        'news_image',
        'news_publish',
        'news_position',
        'is_active',
        'is_hot_news',
        'is_promotion_news'
    ];

    /**
     * Get mapping information by locale for the banner.
     *
     * @return void
     */
    public function translation()
    {
        return $this->hasOne(NewsTranslation::class, 'news_id')->where('locale', config('app.locale'));
    }

    /**
     * Get the locale for the product category.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(NewsTranslation::class, 'news_id');
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
    }

    public function getNewsPublishFormatAttribute()
    {
        return Carbon::parse($this->news_publish)->format('d-m-Y H:i');
    }

    public function getDisplayNewsImageAttribute()
    {
        return !empty($this->news_image) && File::exists(public_path($this->news_image)) ? $this->news_image : config('constants.no_image_url');
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

    /**
     * Scope active
     *
     * @return void
     */
    public function getHotNewsTextAttribute()
    {
        return !empty($this->is_hot_news) ? __('app.status.active') : __('app.status.inactive');
    }

    /**
     * Scope active
     *
     * @return void
     */
    public function getPromotionNewsTextAttribute()
    {
        return !empty($this->is_promotion_news) ? __('app.status.active') : __('app.status.inactive');
    }

    public function getTagArrayAttribute()
    {
        return json_decode($this->tag_id);
    }
}
