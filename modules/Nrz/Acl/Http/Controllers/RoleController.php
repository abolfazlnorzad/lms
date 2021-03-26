<?php

namespace Nrz\Acl\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nrz\Acl\Http\Request\RoleRequest;
use Nrz\Acl\Model\Role;
use Nrz\Acl\Repo\PermissionRepo;
use Nrz\Acl\Repo\RoleRepo;
use Nrz\Common\Response\AjaxResponse;

class RoleController extends Controller
{
    public $repo;

    public function __construct(RoleRepo $roleRepo)
    {
        $this->middleware('can:show-acl')->only("index");
        $this->middleware("can:create-acl")->only(["create","store"]);
        $this->middleware("can:edit-acl")->only(["edit","update"]);
        $this->middleware("can:delete-acl")->only("destroy");
        $this->repo = $roleRepo;
    }

    public function index()
    {
        $roles = $this->repo->getAllRole();
        $permissions = PermissionRepo::getAllPermissions();
        return view('Acl::Role.index', compact('roles', 'permissions'));
    }


    public function store(RoleRequest $request)
    {

        $this->repo->createNewRole($request);

        return redirect(route('roles.index'));
    }


    public function edit(Role $role)
    {
        $permissions = PermissionRepo::getAllPermissions();
        return view('Acl::Role.edit', compact('role', 'permissions'));
    }


    public function update(RoleRequest $request, Role $role)
    {


        $this->repo->updateRole($role, $request);
        return redirect(route('roles.index'));
    }


    public function destroy(Role $role)
    {
        $this->repo->delete($role);
        AjaxResponse::success();

    }
}
