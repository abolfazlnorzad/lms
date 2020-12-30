<?php

namespace Nrz\Acl\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'unique:permissions,id'],
            'label' => 'required'
        ];

        if (request()->method === 'patch') {
            $rules['name'] = 'required|unique:permissions,id,' . request()->id;
        }

        return $rules;
    }
}
