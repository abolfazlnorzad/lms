<?php

namespace Nrz\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Nrz\Comment\Rules\ApprovedCommentRule;
use Nrz\Comment\Rules\IsCommentableRule;

class CommentRequest extends FormRequest
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
            "body" => "required",
            "parent_id" => ['nullable', new ApprovedCommentRule()],
            "commentable_id" => 'required',
            "commentable_type" => ['required', new IsCommentableRule()],
        ];
    }
}
