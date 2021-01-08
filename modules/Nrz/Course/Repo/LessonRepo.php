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

    public function findById($id)
    {
        return Lesson::where('id', $id)->first();
    }

    public function changeConfirmationStatus($lesson, $status)
    {
        return $lesson->update([
            'confirmation_status' => $status
        ]);
    }

    public function changeConfirmationStatusById($ids,$status)
    {
      return Lesson::query()->whereIn('id',$ids)->update([
          'confirmation_status'=>$status
      ]);
    }


    public function changeStatus($lesson, $status)
    {
        return $lesson->update([
            'status' => $status
        ]);
    }

    public function update( $lesson, $course,$values)
    {
        return $lesson->update([
            "title" => $values->title,
            "slug" => $values->slug ? Str::slug($values->slug) : Str::slug($values->title),
            "time" => $values->time,
            "priority" => $this->generateNumber($values->priority, $course->id),
            'media_id' => $values->media_id,
            'body' => $values->body,
            "free" => $values->free
        ]);
    }

    public function acceptAll( $course)
    {
        return Lesson::where('course_id',$course->id)->update([
            'confirmation_status'=>Lesson::CONFIRMATION_STATUS_ACCEPTED
        ]);
    }
}
