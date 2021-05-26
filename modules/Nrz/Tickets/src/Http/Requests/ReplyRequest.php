<?php

namespace Nrz\Tickets\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "body" => "required",
            "attachment" => "nullable|file|mimes:avi,mkv,mp4,zip,rar,png,jpg,jpeg|max:10240",
        ];
    }

    public function attributes()
    {
        return [
            "lesson_file" => "فایل پیوست",
            "body" => "متن تیکت"
        ];
    }

}
