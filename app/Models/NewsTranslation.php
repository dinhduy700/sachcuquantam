<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    use HasFactory;

    protected $table = 'news_translation';

    protected $fillable = [
        'locale',
        'news_id',
        'news_title',
        'news_slug',
        'news_description',
        'news_content',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    /**
     * Get the news that owns the locale.
     *
     * @return void
     */
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
