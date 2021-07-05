<?php

namespace Nrz\Comment\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\User\Model\User;

class Comment extends Model
{
    const STATUS_NEW = "new";
    const STATUS_APPROVED = "approved";
    const STATUS_REJECTED = 'rejected';
    static $statuses = [
        self::STATUS_NEW,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
    ];
    use HasFactory;

    protected $guarded = [];


    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }


    public function childrenWasApproved()
    {
        return $this->children()
            ->where("status", Comment::STATUS_APPROVED);

    }

    public function getStatusCssClass()
    {
        if ($this->status == self::STATUS_APPROVED) return "text-success";
        elseif ($this->status == self::STATUS_REJECTED) return "text-error";

        return "text-warning";
    }

}
