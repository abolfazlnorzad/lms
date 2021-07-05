<?php

namespace Nrz\Comment\Traits;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Nrz\Comment\Model\Comment;

trait HasComments
{
    use HasRelationships;

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function approvedComment()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->where("status", Comment::STATUS_APPROVED)
            ->whereNull("parent_id")->with("children");
    }

}
