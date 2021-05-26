<?php

namespace Nrz\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\User\Model\User;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

     const STATUS_OPEN = "open";
     const STATUS_CLOSE = "close";
     const STATUS_PENDING = "pending";
     const STATUS_REPLIED = "replied";

     static $statuses =[
         self::STATUS_OPEN,
         self::STATUS_CLOSE,
         self::STATUS_PENDING,
         self::STATUS_REPLIED,
     ];

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
