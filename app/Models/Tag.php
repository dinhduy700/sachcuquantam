<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tags';

    protected $fillable = [
        'position',
        'is_active',
    ];

    /**
     * Get mapping information by locale for the banner.
     *
     * @return void
     */
    public function translation()
    {
        return $this->hasOne(TagTranslation::class, 'tag_id')->where('locale', config('app.locale'));
    }

    /**
     * Get the locale for the product category.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(TagTranslation::class, 'tag_id');
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
