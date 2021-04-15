<?php

namespace Nrz\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\User\Model\User;

class Ticket extends Model
{
    use HasFactory;

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function ticketable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
