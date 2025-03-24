<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailThread extends Model
{
    protected $fillable = ['email_id', 'thread_id'];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}
