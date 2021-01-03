<?php

namespace Nrz\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Nrz\User\Model\User;

class UpdateUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            "name" => 'required|min:3|max:190',
            "email" => 'required|email|min:3|max:190|unique:users,email,' . request()->route('user')->id,
            "username" => 'nullable|min:3|max:190|unique:users,username,' . request()->route('user')->id,
            "phone" => 'nullable|unique:users,phone,' . request()->route('user')->id,
            "status" => ["required", Rule::in(User::$statuses)],
            "image" => "nullable|mimes:jpg,png,jpeg",
        ];
    }
    public function attributes()
    {
        return [
            "name" => "نام",
            "email" => "ایمیل",
            "username" => "نام کاربری",
            "phone" => "موبایل",
            "status" => "وضعیت",
            "image" => "عکس پروفایل",
        ];
    }
}
