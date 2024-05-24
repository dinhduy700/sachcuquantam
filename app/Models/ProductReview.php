<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class ProductReview extends Model {

    use HasFactory, SoftDeletes;

    protected $table = 'product_review';

    protected $fillable = [
        'product_id',
        'reply_id',
        'name',
        'email',
        'review_content',
        'file',
        'score',
        'is_active'
    ];

    /**
     * Get the locale for the product translation.
     *
     * @return void
     */
    public function product()
    {
        return $this->hasOne(ProductTranslation::class, 'product_id', 'product_id')->where('locale', config('app.locale'));
    }

    /**
     * Recursive child category
     *
     * @return void
     */
    public function child()
    {
        return $this->hasMany(ProductReview::class, 'reply_id', 'id')->orderBy('created_at', 'DESC');
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

    public function getArrFilesAttribute()
    {
        return json_decode($this->file);
    }
}
