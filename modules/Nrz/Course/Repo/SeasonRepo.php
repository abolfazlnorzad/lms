<?php


namespace Nrz\Course\Repo;


use Nrz\Course\Model\Season;

class SeasonRepo
{

    public function storeNewSeason($values, $id)
    {
        $number = $this->generateNumber($values->number, $id);
        Season::create([
            'title' => $values->title,
            "number" => $number,
            "user_id" => auth()->id(),
            "course_id" => $id
        ]);

    }

    public function update($request, $season)
    {
        $number = $this->generateNumber($request->number, $season->id);
        return $season->update([
            'title' => $request->title,
            "number" => $number,
        ]);
    }


    public function generateNumber($number, $id)
    {
        $courseRepo = new CourseRepo();
        if (is_null($number)) {
            $number = $courseRepo->findById($id)->seasons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }
        return $number;
    }

    public function delete($season)
    {
        return $season->delete();
    }

    public function changeConfirmationStatus($season, $status)
    {
        return $season->update([
            'confirmation_status' => $status
        ]);
    }

    public function changeStatus($season, string $status)
    {
        return $season->update([
            'status' => $status
        ]);
    }

    public function getCourseSeason($course)
    {

        return Season::where('course_id', $course->id)
            ->where('confirmation_status', Season::CONFIRMATION_STATUS_ACCEPTED)
            ->orderBy('number')->get();
    }


    public function findByIdAndCourse($seasonId, $courseId)
    {
        return Season::where('id', $seasonId)->where('course_id', $courseId)->first();
    }

}
