<?php


namespace Nrz\User\Repo;


use Nrz\User\Model\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }



}
