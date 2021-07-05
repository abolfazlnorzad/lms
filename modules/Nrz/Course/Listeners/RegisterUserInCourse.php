<?php

namespace Nrz\Course\Listeners;

use Nrz\Course\Model\Course;
use Nrz\Course\Repo\CourseRepo;

class RegisterUserInCourse
{

    public function __construct()
    {
        //
    }


    public function handle($event)
    {

        if ($event->payment->paymentable_type == Course::class) {
            resolve(CourseRepo::class)->addStudentToCourse($event->payment->paymentable,$event->payment->buyer_id);
        }
    }
}
