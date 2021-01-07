<?php

namespace Nrz\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Nrz\Course\Model\Course;
use Nrz\Course\Rules\TeacherRule;

class SeasonRequest extends FormRequest
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

      return[
            "title" => 'required|min:3|max:190',
            "number" => 'nullable|numeric',
        ];

    }

}
