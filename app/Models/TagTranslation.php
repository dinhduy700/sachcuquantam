<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    use HasFactory;

    protected $table = 'tag_translation';

    protected $fillable = [
        'locale',
        'tag_id',
        'tag_name',
        'tag_slug',
    ];

    /**
     * Get the news that owns the locale.
     *
     * @return void
     */
    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }
}
