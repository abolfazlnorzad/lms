<?php

namespace Nrz\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nrz\Course\Http\Requests\LessonRequest;
use Nrz\Course\Model\Course;
use Nrz\Course\Model\Lesson;
use Nrz\Course\Repo\CourseRepo;
use Nrz\Course\Repo\LessonRepo;
use Nrz\Course\Repo\SeasonRepo;
use Nrz\Media\Services\MediaFileService;

class LessonController extends Controller
{

    public $repo;

    public function __construct(LessonRepo $lessonRepo)
    {
        $this->repo = $lessonRepo;
    }


    public function create(Course $course, SeasonRepo $seasonRepo, CourseRepo $courseRepo)
    {
        $seasons = $seasonRepo->getCourseSeason($course);
        return view('Course::lessons.create', compact('seasons', 'course'));
    }

    public function store(Course $course, LessonRequest $request)
    {
        $request->request->add(["media_id" => MediaFileService::privateUpload($request->file("lesson_file"))->id]);
        $this->repo->createLesson($course, $request);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return redirect(route('courses.details', $course->id));
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        if ($lesson->media){
            $lesson->media->delete();
        }
        $this->repo->delete($lesson);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return redirect(route('courses.details', $course->id));
    }

}
