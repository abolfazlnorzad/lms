<?php

namespace Nrz\Tickets\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "title" => 'required|string',
            "body" => 'required|string',
            "attachment" => "nullable|file|mimes:avi,mkv,mp4,zip,rar,png,jpeg,jpg|max:102400",
        ];
    }

    public function attributes()
    {
        return [
            "title" => 'عنوان تیکت',
            "attachment" => "فایل پیوست",
            "body" => "متن تیکت"
        ];
    }
}
