<?php

namespace Nrz\Comment\Repo;

use Nrz\Acl\Model\Permission;
use Nrz\Comment\Model\Comment;

class CommentRepo
{

    public function paginate()
    {
        return Comment::query()->latest()->paginate();
    }

    public function store($data)
    {
        $TeacherPermission = Permission::query()->where('name','teach')->first();

        return Comment::query()->create([
            "user_id" => auth()->id(),
            "body" => $data['body'],
            "commentable_type" => $data['commentable_type'],
            "commentable_id" => $data['commentable_id'],
            "parent_id" => array_key_exists('parent_id', $data) ? $data['parent_id'] : null,
            "status"=> (auth()->user()->hasPermission($TeacherPermission) || auth()->user()->isAdmin())
            ? Comment::STATUS_APPROVED : Comment::STATUS_NEW
        ]);
    }


}
