<?php

namespace Nrz\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\User\Model\User;

class Settlement extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS_PENDING = "pending";
    const STATUS_SETTLED = "settled";
    const STATUS_REJECTED = "rejected";
    const STATUS_CANCELED = "canceled";

    public static $statuses = [
        self::STATUS_CANCELED,
        self::STATUS_PENDING,
        self::STATUS_REJECTED,
        self::STATUS_SETTLED
    ];

    protected $casts = [
        "to" => "json",
        "from" => "json"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCssClass()
    {
        if ($this->status === self::STATUS_PENDING) return "text-warning";
        if ($this->status === self::STATUS_SETTLED) return "text-success";
        if ($this->status === self::STATUS_REJECTED || $this->status === self::STATUS_CANCELED) return "text-danger";
    }

}
