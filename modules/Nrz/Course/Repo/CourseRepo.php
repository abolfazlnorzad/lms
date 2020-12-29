<?php


namespace Nrz\Course\Repo;


use Nrz\Course\Model\Course;

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

        return Course::query()->paginate();
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

    public function changeConfirmationStatus( $course, $status)
    {
        return $course->update([
            'confirmation_status'=>$status
        ]);
    }

    public function changeStatus( $course, string $status)
    {
        return $course->update([
            'status'=>$status
        ]);
    }
}