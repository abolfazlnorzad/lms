<?php


namespace Nrz\Course\Repo;


use Illuminate\Support\Str;
use Nrz\Course\Model\Lesson;

class LessonRepo
{

    public function generateNumber($number, $id)
    {
        $courseRepo = new CourseRepo();
        if (is_null($number)) {
            $number = $courseRepo->findById($id)->lessons()->orderBy('priority', 'desc')->firstOrNew([])->priority ?: 0;
            $number++;
        }
        return $number;
    }

    public function createLesson($course, $values)
    {
        return Lesson::create([
            "title" => $values->title,
            "slug" => $values->slug ? Str::slug($values->slug) : Str::slug($values->title),
            "time" => $values->time,
            "priority" => $this->generateNumber($values->priority, $course->id),
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'course_id' => $course->id,
            'user_id' => auth()->id(),
            'body' => $values->body,
            'confirmation_status' => Lesson::CONFIRMATION_STATUS_PENDING,
            "status" => Lesson::STATUS_OPENED,
            "free" => $values->free
        ]);
    }

    public function delete($lesson)
    {
        return $lesson->delete();
    }
}
