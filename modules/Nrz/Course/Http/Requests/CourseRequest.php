<?php

namespace Nrz\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Nrz\Course\Model\Course;
use Nrz\Course\Rules\TeacherRule;

class CourseRequest extends FormRequest
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
            "title" => 'required|min:3|max:190',
            "slug" => 'required|min:3|max:190|unique:courses,slug',
            "priority" => 'nullable|numeric',
            "price" => 'required|numeric|min:0|max:10000000',
            "percent" => 'required|numeric|min:0|max:100',
            "teacher_id" => ['required','exists:users,id', new TeacherRule()],
            "type" => ["required", Rule::in(Course::$types)],
            "status" => ["required", Rule::in(Course::$statuses)],
            "category_id" => "required|exists:categories,id",
            "image" => "required|mimes:jpg,png,jpeg",
        ];
        if (request()->method === 'PATCH') {
            $rules['image'] = "nullable|mimes:jpg,png,jpeg";
            $rules['slug'] = 'required|min:3|max:190|unique:courses,slug,'.request()->route('course')->id;
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            "price" => "قیمت",
            "slug" => "عنوان انگلیسی",
            "priority" => "ردیف دوره",
            "percent" => "درصد مدرس",
            "teacher_id" => "مدرس",
            "category_id" => "دسته بندی",
            "status" => "وضعیت",
            "type" => "نوع",
            "body" => "توضیحات",
            "image" => "بنر دوره",
        ];
    }
}
