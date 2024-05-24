<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    use HasFactory;

    protected $table = 'banner_translation';

    protected $fillable = [
        'locale',
        'banner_id',
        'banner_title',
        'banner_image',
        'banner_link',
        'banner_content'
    ];

    /**
     * Get the banner that owns the locale.
     *
     * @return void
     */
    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
