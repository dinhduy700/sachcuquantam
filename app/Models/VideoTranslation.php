<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoTranslation extends Model
{
    use HasFactory;

    protected $table = 'video_translation';

    protected $fillable = [
        'locale',
        'video_id',
        'video_title',
        'video_slug',
        'video_link'
    ];

    /**
     * Get the news that owns the locale.
     *
     * @return void
     */
    public function videos()
    {
        return $this->belongsTo(Video::class);
    }
}
