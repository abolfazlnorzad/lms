<?php

namespace Nrz\Comment\Rules;

use Illuminate\Contracts\Validation\Rule;
use Nrz\Comment\Model\Comment;

class ApprovedCommentRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ! is_null(Comment::query()->where('id',$value)
            ->where('status',Comment::STATUS_APPROVED)->first());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
