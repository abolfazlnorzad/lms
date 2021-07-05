<?php

namespace Nrz\Acl\Http\Controllers;

use App\Http\Controllers\Controller;
use Nrz\Acl\Http\Request\PermissionRequest;
use Nrz\Acl\Model\Permission;
use Nrz\Acl\Repo\PermissionRepo;
use Nrz\Common\Response\AjaxResponse;

class PermissionController extends Controller
{
    public $repo;

    public function __construct(PermissionRepo $permissionRepo)
    {
        $this->middleware('can:show-acl')->only("index");
        $this->middleware("can:create-acl")->only(["create","store"]);
        $this->middleware("can:edit-acl")->only(["edit","update"]);
        $this->middleware("can:delete-acl")->only("destroy");
        $this->repo = $permissionRepo;
    }

    public function index()
    {
        $permissions = $this->repo->getAllPermissions();
        return view('Acl::Permission.index',compact('permissions'));
    }


    public function store(PermissionRequest $request)
    {
        $this->repo->createNewPermission($request);

        return redirect(route('permissions.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('Acl::Permission.edit',compact('permission'));
    }


    public function update(PermissionRequest $request, Permission $permission)
    {

        $this->repo->updatePermission($permission,$request);
        return redirect(route('permissions.index'));
    }


    public function destroy(Permission $permission)
    {
        $this->repo->delete($permission);
        return AjaxResponse::success();
    }
}
