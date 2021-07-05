<?php

namespace Nrz\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Nrz\Acl\Model\Permission;
use Nrz\Acl\Model\Role;
use Nrz\Acl\Repo\PermissionRepo;
use Nrz\Acl\Repo\RoleRepo;
use Nrz\Common\Response\AjaxResponse;
use Nrz\Media\Services\MediaFileService;
use Nrz\User\Http\Requests\addPermissionRequest;
use Nrz\User\Http\Requests\addRoleRequest;
use Nrz\User\Http\Requests\UpdateProfileRequest;
use Nrz\User\Http\Requests\UpdateUserRequest;
use Nrz\User\Http\Requests\UserPhotoRequest;
use Nrz\User\Model\User;
use Nrz\User\Repo\UserRepo;

class UserController extends Controller
{

    public $repo;

    public function __construct(UserRepo $userRepo)
    {
        $this->middleware("can:show-user")->only("index");
        $this->middleware("can:delete-user")->only("destroy");
        $this->middleware("can:edit-user")->only(["edit","update"]);
        $this->repo = $userRepo;
    }


    public function index()
    {
        $users = $this->repo->paginate();
        $permissions = PermissionRepo::getAllPermissions();
        $roles =RoleRepo::AllRole();

        return view('User::admin.index', compact('users', 'permissions','roles'));
    }






    public function edit(User $user)
    {
        return view('User::admin.edit', compact('user'));

    }


    public function update(UpdateUserRequest $request, User $user)
    {

        if ($request->hasFile('image')) {
            $request->request->add(['image_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        } else {
            $request->request->add(['image_id' => $user->image_id]);

        }
        $this->repo->update($user, $request);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->repo->delete($user);
        return AjaxResponse::success();
    }


    public function addPermission(addPermissionRequest $request, User $user)
    {
        $user->permissions()->attach($request->permission);
        newFeedback('موفقیت آمیز', "عملیات با موفقیت انجام شد", 'success');
        return back();
    }
    public function addRole(addRoleRequest $request, User $user)
    {
        $user->roles()->attach($request->role);
        newFeedback('موفقیت آمیز', "عملیات با موفقیت انجام شد", 'success');
        return back();
    }

    public function removePermission(User $user, Permission $permission)
    {
        $user->permissions()->toggle($permission->id);
        return AjaxResponse::success();
    }
    public function removeRole(User $user, Role $role)
    {
        $user->roles()->toggle($role->id);
        return AjaxResponse::success();
    }


    public function usersManualVerify(User $user)
    {
        $user->markEmailAsVerified();
        return AjaxResponse::success();
    }


    public function usersPhoto(UserPhotoRequest $request)
    {
        $media = MediaFileService::publicUpload($request->file('userPhoto'));
        if (auth()->user()->image) {
            auth()->user()->image->delete();
        }
        auth()->user()->image_id = $media->id;
        auth()->user()->save();
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return back();
    }


    public function profile()
    {
        return view('User::admin.profile');
    }

    public function UpdateProfile(UpdateProfileRequest $request)
    {
        $this->repo->updateProfile($request);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return back();
    }

    public function viewProfile()
    {

    }


    public function info(User $user)
    {
        return view("User::Admin.info",compact('user'));
    }

}
