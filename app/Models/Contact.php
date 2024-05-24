<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Contact extends Model {

    use HasFactory, SoftDeletes;

    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'content',
        'status'
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
        return !empty($this->status) ? __('app.contacts.approved') : __('app.contacts.pending');
    }
}
