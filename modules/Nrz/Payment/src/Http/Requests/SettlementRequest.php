<?php

namespace Nrz\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Nrz\Payment\Models\Settlement;

class SettlementRequest extends FormRequest
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
        if (request()->getMethod() === "PATCH") {
            return [
                "to.name" => "required_if:status," . Settlement::STATUS_SETTLED,
                "from.name" => "required_if:status," . Settlement::STATUS_SETTLED,
                "to.cart" => "required_if:status," . Settlement::STATUS_SETTLED,
                "from.cart" => "required_if:status," . Settlement::STATUS_SETTLED,
                "amount" => "required|numeric"
            ];
        } else {
            return [
                "name" => "required|string",
                "cart" => "required|numeric",
                "amount" => "required|numeric|min:10000|max:" . auth()->user()->balance,
            ];
        }
    }


    public function attributes()
    {
        return [
            "cart" => "کارت بانکی",
            "amount" => "مبلغ تسویه حساب"
        ];
    }
}
