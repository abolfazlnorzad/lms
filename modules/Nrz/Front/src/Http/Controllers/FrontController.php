<?php

namespace Nrz\Front\Http\Controllers;


use Illuminate\Support\Str;
use Nrz\Course\Model\Course;
use Nrz\Course\Repo\LessonRepo;
use Nrz\User\Repo\UserRepo;

class FrontController
{
    public function index()
    {
        return view("Front::index");
    }

    public function singleCourse($slug, LessonRepo $lessonRepo)
    {
        $courseId = $this->extractId($slug, 'c');
        $lessons = $lessonRepo->getAcceptedLessons($courseId);
        $course = Course::where('id', $courseId)->first();
        if (request()->lesson) {
            $lesson = $lessonRepo->getLesson($courseId, $this->extractId(request()->lesson, 'l'));
        } else {
            $lesson = $lessonRepo->getFirstLesson($courseId);
        }
        return view('Front::singleCourse', compact('course', 'lessons', 'lesson'));
    }

    public function extractId($slug, $key)
    {
        return Str::before(Str::after($slug, $key . '-'), '-');
    }

    public function singleTutor($username,UserRepo $userRepo)
    {

        $tutor = $userRepo->getTeachers()->where('username',$username)->first();

        return view("Front::tutor", compact('tutor'));
    }
}
