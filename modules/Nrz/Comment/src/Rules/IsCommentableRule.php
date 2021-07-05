<?php

namespace Nrz\Comment\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsCommentableRule implements Rule
{

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        return class_exists($value) && method_exists($value, 'comments');
    }


    public function message()
    {
        return 'The validation error message.';
    }
}
