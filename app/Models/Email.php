<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $guarded = [];

    protected $casts = [
        'flags' => 'array',
        'received_at' => 'datetime',
    ];

    public function threads()
    {
        return $this->hasMany(EmailThread::class);
    }


    public function attachments()
    {
        return $this->hasMany(EmailThread::class);
    }
}
