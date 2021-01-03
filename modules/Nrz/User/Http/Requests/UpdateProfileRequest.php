<?php

namespace Nrz\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Nrz\Acl\Model\Permission;
use Nrz\User\Rules\ValidPassword;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            "name" => 'required|min:3|max:190',
            "email" => 'required|email|min:3|max:190|unique:users,email,' . auth()->id(),
            "username" => 'nullable|min:3|max:190|unique:users,username,' .  auth()->id(),
            "phone" => 'nullable|unique:users,phone,' . request()->route('user'),
            'password' => ['nullable', new ValidPassword()]

        ];
        $teachPermission = Permission::where('name', 'teach')->first();
        if (auth()->user()->hasPermission($teachPermission)) {
            $rules += [
                "card_number" => 'required|string|size:16',
                "shaba" => 'required|size:24',
                "headline" => 'required|min:3|max:60',
                "bio" => 'required',
            ];
            $rules['username'] = 'required|min:3|max:190|unique:users,username,' .  auth()->id();
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'shaba' => 'شماره شبای بانکی',
            'card_number' => 'شماره کارت بانکی',
            'username' => 'نام کاربری',
            'headline' => 'عنوان',
            'bio' => 'بیو',
            "password" => 'رمز عبور جدید',
            "phone" => "موبایل",
        ];
    }
}
