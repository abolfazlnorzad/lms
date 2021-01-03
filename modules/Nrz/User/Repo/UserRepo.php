<?php


namespace Nrz\User\Repo;


use Nrz\Acl\Model\Permission;
use Nrz\User\Model\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function getTeachers()
    {
        $teachPermission = Permission::where('name', 'teach')->first();

        $allUsers = User::all();
        $teacherUsers = $allUsers->filter(function ($user) use ($teachPermission) {
            return $user->hasPermission($teachPermission);
        });
        return $teacherUsers;
    }

    public function findById($id)
    {
        return User::query()->where('id', $id)->first();
    }

    public function paginate()
    {
        return User::query()->paginate();
    }

    public function update($user, $values)
    {
        $update = [
            'name' => $values->name,
            'email' => $values->email,
            'phone' => $values->mobile,
            'username' => $values->username,
            'headline' => $values->headline,
            'status' => $values->status,
            'bio' => $values->bio,
            'image_id' => $values->image_id
        ];
        if (!is_null($values->password)) {
            $update['password'] = bcrypt($values->password);
        }

        return $user->update($update);

    }

    public function delete($user)
    {
        return $user->delete();
    }

    public function updateProfile($request)
    {
        auth()->user()->name = $request->name;
        if (auth()->user()->email != $request->email) {
            auth()->user()->email = $request->email;
            auth()->user()->email_verified_at = null;
        }
        $teachPermission = Permission::where('name', 'teach')->first();
        if (auth()->user()->hasPermission($teachPermission)) {
            auth()->user()->card_number = $request->card_number;
            auth()->user()->shaba = $request->shaba;
            auth()->user()->headline = $request->headline;
            auth()->user()->bio = $request->bio;
            auth()->user()->username = $request->username;
        }

        if ($request->password) {
            auth()->user()->password = bcrypt($request->password);
        }

        auth()->user()->save();
    }


}
