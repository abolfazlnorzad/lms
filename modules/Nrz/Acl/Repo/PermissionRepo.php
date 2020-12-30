<?php


namespace Nrz\Acl\Repo;


use Nrz\Acl\Model\Permission;

class PermissionRepo
{

    public static function getAllPermissions()
    {
        return Permission::all();
    }

    public static function createNewPermission($request)
    {
        return Permission::create([
            'name' => $request->name,
            'label' => $request->label,
        ]);
    }

    public function delete($permission)
    {
        return $permission->delete();
    }

    public function updatePermission($permission, $request)
    {

        return $permission->update([
            'name' => $request->name,
            'label' => $request->label,
        ]);
    }
}
