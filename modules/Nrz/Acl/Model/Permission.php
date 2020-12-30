<?php

namespace Nrz\Acl\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function roles()
    {
        return $this->belongsToMany(Role::class);

    }

}
