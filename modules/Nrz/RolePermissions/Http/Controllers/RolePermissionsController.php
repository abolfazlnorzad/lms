<?php

namespace Nrz\RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Nrz\Category\Response\AjaxResponse;
use Nrz\RolePermissions\Http\Requests\RoleRequest;
use Nrz\RolePermissions\Http\Requests\RoleUpdateRequest;
use Nrz\RolePermissions\Repositories\RoleRepo;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController extends Controller
{
    public $repo;

    public function __construct(RoleRepo $roleRepo)
    {
        $this->repo = $roleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $roles = $this->repo->getAllRole();
        $permissions = $this->repo->getAllPermissions();
        return view('RolePermissions::index', compact('roles', 'permissions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->repo->createNewRole($request);
        return redirect(route('role-permissions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $role = $this->repo->findById($id);

        $permissions = $this->repo->getAllPermissions();
        return view('RolePermissions::edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, RoleUpdateRequest $request)
    {
        $this->repo->updateRole($id, $request);
        return redirect(route('role-permissions.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return AjaxResponse::success();

    }
}
