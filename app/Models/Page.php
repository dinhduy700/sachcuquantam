<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pages';

    protected $fillable = [
        'page_name',
        'page_images',
        'is_active',
    ];

    /**
     * Get mapping information by locale for the page.
     *
     * @return void
     */
    public function translation()
    {
        return $this->hasOne(PageTranslation::class, 'page_id')->where('locale', config('app.locale'));
    }

    /**
     * Get the locale for the product category.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(PageTranslation::class, 'page_id');
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
