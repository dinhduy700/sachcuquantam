<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Subscribe extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'subscribes';

    protected $fillable = [
        'email',
        'is_active',
    ];

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
        return !empty($this->is_active) ? __('app.subscribes.active') : __('app.subscribes.inactive');
    }
}
