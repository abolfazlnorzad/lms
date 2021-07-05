<?php

namespace Nrz\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Nrz\Common\Response\AjaxResponse;
use Nrz\Course\Http\Requests\SeasonRequest;
use Nrz\Course\Model\Lesson;
use Nrz\Course\Model\Season;
use Nrz\Course\Repo\SeasonRepo;

class SeasonController extends Controller
{
    public $repo;

    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->repo = $seasonRepo;
    }

    public function store(SeasonRequest $request, $seasonId, SeasonRepo $seasonRepo)
    {
        $seasonRepo->storeNewSeason($request, $seasonId);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return back();
    }

    public function edit(Season $season)
    {
        return view('Course::seasons.edit', compact('season'));
    }

    public function update(SeasonRequest $request, Season $season)
    {
        $this->repo->update($request,$season);
        newFeedback('موفقیت آمیز', 'عملیات موفقیت آمیز بود', 'success');
        return back();
    }


    public function destroy(Season $season)
    {
        $this->repo->delete($season);

        return AjaxResponse::success();
    }

    public function accept(Season $season)
    {
        if ($this->repo->changeConfirmationStatus($season,Lesson::CONFIRMATION_STATUS_ACCEPTED)){
            return   AjaxResponse::success();
        }
        return AjaxResponse::error();
    }


    public function reject(Season $season)
    {
        if ($this->repo->changeConfirmationStatus($season,Lesson::CONFIRMATION_STATUS_REJECTED)){
            return   AjaxResponse::success();
        }

        return AjaxResponse::error();
    }

    public function lock(Season $season)
    {
        if ($this->repo->changeStatus($season,Lesson::STATUS_LOCKED)){
            return   AjaxResponse::success();
        }

        return AjaxResponse::error();
    }

    public function unlock(Season $season)
    {
        if ($this->repo->changeStatus($season,Lesson::STATUS_OPENED)){
            return   AjaxResponse::success();
        }

        return AjaxResponse::error();
    }


}
