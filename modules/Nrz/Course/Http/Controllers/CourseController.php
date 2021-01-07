<?php

namespace Nrz\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Nrz\Category\Repo\CategoryRepo;
use Nrz\Common\Response\AjaxResponse;
use Nrz\Course\Http\Requests\CourseRequest;
use Nrz\Course\Model\Course;
use Nrz\Course\Repo\CourseRepo;
use Nrz\Media\Services\ImageFileService;
use Nrz\Media\Services\MediaFileService;
use Nrz\User\Repo\UserRepo;

class CourseController extends Controller
{
    public $repo;

    public function __construct(CourseRepo $courseRepo)
    {
        $this->repo = $courseRepo;
    }


    public function index()
    {
        $courses = $this->repo->paginate();
        return view('Course::index', compact('courses'));
    }


    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->allCategory();
        return view('Course::create', compact('teachers', 'categories'));
    }


    public function store(CourseRequest $request)
    {
        $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        $course = $this->repo->storeNewCourse($request);
        return redirect(route('courses.index'));
    }


    public function show($id)
    {
        //
    }


    public function edit(Course $course,UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->allCategory();
        return view('Course::edit', compact('course','teachers', 'categories'));
    }


    public function update( Course $course ,CourseRequest $request)
    {

       if ($request->hasFile('image')){

           $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('image'))->id]);
          $course->banner->delete();
       }else{

           $request->request->add(['banner_id'=>$course->banner_id]);
       }

        $this->repo->update($request,$course);
        return redirect(route('courses.index'));
    }


    public function destroy(Course $course)
    {
        $this->repo->delete($course);

        return AjaxResponse::success();
    }

    public function accept(Course $course)
    {
        if ($this->repo->changeConfirmationStatus($course,Course::CONFIRMATION_STATUS_ACCEPTED)){
         return   AjaxResponse::success();
        }

        return AjaxResponse::error();
    }


    public function reject(Course $course)
    {
        if ($this->repo->changeConfirmationStatus($course,Course::CONFIRMATION_STATUS_REJECTED)){
            return   AjaxResponse::success();
        }

        return AjaxResponse::error();
    }

    public function lock(Course $course)
    {
        if ($this->repo->changeStatus($course,Course::STATUS_LOCKED)){
            return   AjaxResponse::success();
        }

        return AjaxResponse::error();
    }

    public function details(Course $course)
    {

        return view('Course::details',compact('course'));

    }


}
