<?php


namespace Nrz\Course\Repo;


use Nrz\Course\Model\Course;
use Nrz\Course\Model\Lesson;

class CourseRepo
{
    public function storeNewCourse($values)
    {
        return Course::create([
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'title' => $values->title,
            'slug' => $values->slug,
            'priority' => $values->priority,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
            'banner_id' => $values->banner_id
        ]);
    }

    public function paginate()
    {
        if (auth()->user()->isAdmin()) {
            return Course::query()->paginate();
        } else {
            return Course::query()->where("teacher_id", auth()->id())->paginate();
        }

    }

    public function delete($course)
    {
        if ($course->banner) {

            $course->banner->delete();
        }
        $course->delete();
    }

    public function update($values, $course)
    {
        $course->update([
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'title' => $values->title,
            'slug' => $values->slug,
            'priority' => $values->priority,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
            'banner_id' => $values->banner_id
        ]);
    }

    public function changeConfirmationStatus($course, $status)
    {
        return $course->update([
            'confirmation_status' => $status
        ]);
    }

    public function changeStatus($course, string $status)
    {
        return $course->update([
            'status' => $status
        ]);
    }

    public function findById($course)
    {
        return Course::where('id', $course)->first();
    }

    public function latestCourses()
    {
        return Course::where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)
            ->latest()->take(8)->get();
    }

    public function getDuration($courseId)
    {
        return Lesson::where('course_id', $courseId)->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED)
            ->sum('time');
    }

    public function getLessonCount($id)
    {
        return Lesson::query()->where('course_id', $id)
            ->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED)
            ->count();
    }

    public function addStudentToCourse(Course $course, $userId)
    {
        if (!$this->checkStudentInCourse($course, $userId)) {
            $course->students()->attach($userId);
        }
    }

    public function checkStudentInCourse(Course $course, $userId)
    {
        return $course->students()->where("id", $userId)->first();
    }

    public function getCourseLessonsLink(Course $course)
    {
        return Lesson::query()->where('course_id', $course->id)
            ->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED)->get();
    }

    public function getCourseHasSuccessStatus()
    {
        return Course::query()->where("confirmation_status", Course::CONFIRMATION_STATUS_ACCEPTED)
            ->latest()->get();
    }

}
