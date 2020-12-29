<?php

namespace Nrz\Course\Rules;

use Illuminate\Contracts\Validation\Rule;
use Nrz\User\Repo\UserRepo;

class TeacherRule implements Rule
{


    /**
     * Create a new rule instance.
     *
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = resolve(UserRepo::class)->findById($value);
        if ($user->hasPermissionTo('teach')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'کاربر مورد نظر ، مدرس نمی باشد';
    }
}
