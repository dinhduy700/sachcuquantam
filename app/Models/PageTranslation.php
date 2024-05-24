<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    use HasFactory;

    protected $table = 'page_translation';

    protected $fillable = [
        'locale',
        'page_id',
        'page_title',
        'page_slug',
        'page_description',
        'page_content',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];
}
