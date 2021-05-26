<?php

namespace Nrz\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\User\Model\User;

class Reply extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = "ticket_replies";
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
