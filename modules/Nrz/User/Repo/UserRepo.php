<?php


namespace Nrz\User\Repo;


use Nrz\User\Model\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function getTeachers()
    {
        return User::query()->permission('teach')->get();
    }

    public function findById($id)
    {
        return User::query()->where('id', $id)->first();
    }


}
