<?php

namespace Nrz\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nrz\Common\Response\AjaxResponse;
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
        if ($lesson->media) {
            $lesson->media->delete();
        }
        $this->repo->delete($lesson);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return redirect(route('courses.details', $course->id));
    }

    public function destroyMultiple(Course $course, Request $request)
    {

        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
            $lesson = $this->repo->findById($id);
            if ($lesson->media) {
                $lesson->media->delete();
            }
            $this->repo->delete($lesson);

        }
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return back();
    }


    public function accept(Lesson $lesson)
    {
        if ($this->repo->changeConfirmationStatus($lesson, Lesson::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponse::success();
        }
        return AjaxResponse::error();
    }

    public function reject(Lesson $lesson)
    {
        if ($this->repo->changeConfirmationStatus($lesson, Lesson::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponse::success();
        }
        return AjaxResponse::error();
    }


    public function lock(Lesson $lesson)
    {
        if ($this->repo->changeStatus($lesson, Lesson::STATUS_LOCKED)) {
            return AjaxResponse::success();
        }
        return AjaxResponse::error();
    }

    public function unlock(Lesson $lesson)
    {
        if ($this->repo->changeStatus($lesson, Lesson::STATUS_OPENED)) {
            return AjaxResponse::success();
        }
        return AjaxResponse::error();
    }

    public function edit(Course $course, Lesson $lesson, SeasonRepo $seasonRepo)
    {
        $seasons = $seasonRepo->getCourseSeason($course);

        return view('Course::lessons.edit', compact('course', 'lesson', 'seasons'));
    }

    public function update(Course $course, Lesson $lesson, LessonRequest $request)
    {

        if ($request->hasFile('lesson_file')) {
            if ($lesson->media) {
                $lesson->media->delete();
            }
            $request->request->add(["media_id" => MediaFileService::privateUpload($request->file('lesson_file'))->id]);

        } else {
            $request->request->add(['media_id' => $lesson->media_id]);
        }
        $this->repo->update($lesson, $course, $request);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return redirect(route('courses.details', $course->id));
    }

    public function acceptAll(Course $course)
    {
        $this->repo->acceptAll($course);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return redirect(route('courses.details', $course->id));
    }


    public function acceptMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $this->repo->changeConfirmationStatusById($ids,Lesson::CONFIRMATION_STATUS_ACCEPTED);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');

        return back();

    }


    public function rejectMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $this->repo->changeConfirmationStatusById($ids,Lesson::CONFIRMATION_STATUS_REJECTED);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');

        return back();

        }

    }
