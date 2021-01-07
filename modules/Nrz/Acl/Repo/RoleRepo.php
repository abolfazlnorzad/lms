<?php


namespace Nrz\Acl\Repo;


use Nrz\Acl\Model\Role;

class RoleRepo
{



    public static function AllRole()
    {
        return Role::all();
    }
    public  function getAllRole()
    {
        return Role::all();
    }

    public static function createNewRole($request)
    {

        $role = Role::create([
            'name' => $request->name,
            'label' => $request->label,
        ]);

        $role = $role->permissions()->sync($request->permissions);
        return $role;

    }

    public static function delete($role)
    {
        $role->delete();
    }

    public static function updateRole($role, $request)
    {
         $role->update([
            'name' => $request->name,
            'label' => $request->label,
        ]);

      $role->permissions()->sync($request->permissions);
        return ;
    }
}
