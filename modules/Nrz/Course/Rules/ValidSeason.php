<?php

namespace Nrz\Course\Rules;

use Illuminate\Contracts\Validation\Rule;
use Nrz\Acl\Model\Permission;
use Nrz\Course\Repo\SeasonRepo;
use Nrz\User\Repo\UserRepo;

class ValidSeason implements Rule
{


    /**
     * Create a new rule instance.
     *
     */
    public function __construct()
    {

    }


    public function passes($attribute, $value)
    {

        $season = resolve(SeasonRepo::class)->findByIdAndCourse($value, request()->route('course')->id);

        if ($season) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'سر فصل انتخاب شده معتبر نمیباشد';
    }
}
