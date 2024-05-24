<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;

    protected $table = 'setting_translation';

    protected $fillable = [
        'locale',
        'setting_id',
        'site',
        'description',
        'office',
        'working_time',
        'address',
        'bank_information',
        'policy',
        'payment_at',
        'shipping_fee',
        'staffs',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    /**
     * Get the banner that owns the locale.
     *
     * @return void
     */
    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }
}
