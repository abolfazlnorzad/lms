<?php


namespace Nrz\RolePermissions\Repositories;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepo
{
    public function getAllRole()
    {
        return Role::all();
    }

    public function getAllPermissions()
    {
        return Permission::all();
    }

    public function createNewRole($request)
    {
        return Role::create([
            'name' => $request->name
        ])->syncpermissions($request->permissions);
    }

    public function findById($id)
    {
        return Role::where('id', $id)->first();
    }

    public function updateRole($id, $request)
    {
        $role = $this->findById($id);
        $role->syncpermissions($request->permissions)->update(['name'=>$request->name]);
    }

    public function delete($id)
    {
        $role=$this->findById($id);
        $role->delete();
    }
}
