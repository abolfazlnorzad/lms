<?php

namespace Nrz\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Nrz\Course\Rules\ValidSeason;

class LessonRequest extends FormRequest
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
            "title" => 'required|min:3|max:190',
            "slug" => 'nullable|min:3|max:190|unique:lessons,slug',
            "number" => 'nullable|numeric',
            "time" => 'required|numeric|min:0|max:255',
            "season_id" => [ new ValidSeason() ],
            "free" => "required|boolean",
            "lesson_file" => "required|file|mimes:avi,mkv,mp4,zip,rar",
            "body"=>"nullable|string"
        ];

//        if (request()->method === 'PATCH') {
//            $rules['lesson_file'] = 'nullable|file|mimes:' . MediaFileService::getExtensions();
//        }
        return $rules;
    }

    public function attributes()
    {
        return [
            "title" => 'عنوان درس',
            "slug" => 'عنوان انگلیسی درس',
            "number" => 'شماره درس',
            "time" => 'مدت زمان درس',
            "season_id" => "سرفصل",
            "free" => "رایگان",
            "lesson_file" => "فایل درس",
            "body" => "توضیحات درس"
        ];
    }
}
