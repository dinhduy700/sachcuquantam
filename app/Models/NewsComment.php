<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class NewsComment extends Model {

    use HasFactory, SoftDeletes;

    protected $table = 'news_comment';

    protected $fillable = [
        'news_id',
        'name',
        'email',
        'comment',
        'is_active'
    ];

    /**
     * Get mapping information by locale for the banner.
     *
     * @return void
     */
    public function news()
    {
        return $this->hasOne(NewsTranslation::class, 'news_id', 'news_id')->where('locale', config('app.locale'));
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
    }

    /**
     * Scope active
     *
     * @return void
     */
    public function getActiveTextAttribute()
    {
        return !empty($this->is_active) ? __('app.contacts.approved') : __('app.contacts.pending');
    }
}
