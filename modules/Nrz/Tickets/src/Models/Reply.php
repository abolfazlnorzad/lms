<?php

namespace Nrz\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\User\Model\User;

class Reply extends Model
{
    use HasFactory;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
