<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'video_image',
        'video_position',
        'is_active',
    ];

    /**
     * Get mapping information by locale for the banner.
     *
     * @return void
     */
    public function translation()
    {
        return $this->hasOne(VideoTranslation::class, 'video_id')->where('locale', config('app.locale'));
    }

    /**
     * Get the locale for the product category.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(VideoTranslation::class, 'video_id');
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
