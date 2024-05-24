<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'logo',
        'logo_footer',
        'email',
        'tel',
        'hotline',
        'fax',
        'map',
        'facebook',
        'google_plus',
        'pinterest',
        'instagram',
        'twitter',
        'youtube',
        'zalo',
        'tiktok',
        'fanpage',
        'fb_script',
        'zalo_script',
        'google_analystics',
        'ecommerce_industry'
    ];

    /**
     * Get mapping information by locale for the banner.
     *
     * @return void
     */
    public function translation()
    {
        return $this->hasOne(SettingTranslation::class, 'setting_id')->where('locale', config('app.locale'));
    }

    /**
     * Get the locale for the setting
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(SettingTranslation::class, 'setting_id');
    }
}
