<?php

namespace Nrz\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\User\Model\User;

class Payment extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    const STATUS_PENDING = 'pending';
    const STATUS_CANCELED = 'canceled';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';
    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_CANCELED,
        self::STATUS_SUCCESS,
        self::STATUS_FAIL,
    ];

    protected $guarded = [];

    public function paymentable()
    {
        return $this->morphTo("paymentable");
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, "buyer_id");
    }
}
