<?php

namespace Nrz\Discount\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Nrz\Discount\Rules\ValidJalaliDate;

class DiscountRequest extends FormRequest
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
        $rules =  [
            "code" => "nullable|max:50|unique:discounts,code",
            "percent" => "required|numeric|min:1|max:100",
            "usage_limitation" => "nullable|numeric|min:0|max:1000000000",
            "expire_at" => ["nullable",new ValidJalaliDate()],
            "courses" => "nullable|array",
            "type" => "required"
        ];
        if (request()->getMethod() == "PATCH"){
            $rules["code"] = "nullable|max:50|unique:discounts,code," . request()->route("discount")->id;
        }

        return $rules;
    }
}
