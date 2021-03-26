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

use Nrz\Payment\Gateways\Gateway;
use Nrz\Payment\Services\PaymentService;
use Nrz\User\Repo\UserRepo;


class CourseController extends Controller
{
    public $repo;

    public function __construct(CourseRepo $courseRepo)
    {
        $this->middleware("can:teach")->only("index");
        $this->repo = $courseRepo;
    }


    public function index()
    {
        $courses = $this->repo->paginate();
        return view('Course::index', compact('courses'));
    }


    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $this->authorize(auth()->user()->isAdmin());
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->allCategory();
        return view('Course::create', compact('teachers', 'categories'));
    }


    public function store(CourseRequest $request)
    {
        $this->authorize(auth()->user()->isAdmin());
        $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        $course = $this->repo->storeNewCourse($request);
        return redirect(route('courses.index'));
    }


    public function edit(Course $course, UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->allCategory();
        return view('Course::edit', compact('course', 'teachers', 'categories'));
    }


    public function update(Course $course, CourseRequest $request)
    {

        if ($request->hasFile('image')) {
            $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('image'))->id]);
            $course->banner->delete();
        } else {

            $request->request->add(['banner_id' => $course->banner_id]);
        }

        $this->repo->update($request, $course);
        return redirect(route('courses.index'));
    }

    public function destroy(Course $course)
    {
        $this->repo->delete($course);

        return AjaxResponse::success();
    }

    public function accept(Course $course)
    {
        if ($this->repo->changeConfirmationStatus($course, Course::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponse::success();
        }

        return AjaxResponse::error();
    }

    public function reject(Course $course)
    {
        if ($this->repo->changeConfirmationStatus($course, Course::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponse::success();
        }

        return AjaxResponse::error();
    }

    public function lock(Course $course)
    {
        if ($this->repo->changeStatus($course, Course::STATUS_LOCKED)) {
            return AjaxResponse::success();
        }

        return AjaxResponse::error();
    }

    public function details(Course $course)
    {
        if ($course->teacher_id == auth()->user()->id || auth()->user()->isAdmin()){
            return view('Course::details', compact('course'));
        }
        abort(403);


    }

    public function buy(Course $course)
    {

        if (!$this->courseCanBePurchased($course)) {
            return back();
        }

        if (!$this->authUserCanPurchaseCourse($course)) {
            return back();
        }

        $amount = $course->getFinalPrice();
        if ($amount <= 0) {
            $this->repo->addStudentToCourse($course, auth()->id());
            newFeedback(" موفقیت آمیز", "خرید دوره موفقیت آمیز", "success");
            return redirect($course->path());
        }
        $payment = PaymentService::generate($amount, $course, auth()->user());

        resolve(Gateway::class)->redirect();

    }

    private function courseCanBePurchased(Course $course)
    {
        if ($course->type == Course::TYPE_FREE) {
            newFeedback("عملیات ناموفق", "دوره های رایگان قابل خریداری نیستند!", "error");
            return false;
        }
        if ($course->status == Course::STATUS_LOCKED) {
            newFeedback("عملیات ناموفق", "این دوره قفل شده است و قعلا قابل خریداری نیست!", "error");
            return false;
        }

        if ($course->confirmation_status != Course::CONFIRMATION_STATUS_ACCEPTED) {
            newFeedback("عملیات ناموفق", "دوره ی انتخابی شما هنوز تایید نشده است!", "error");
            return false;
        }


        return true;
    }

    private function authUserCanPurchaseCourse(Course $course)
    {
        if (auth()->id() == $course->teacher_id) {
            newFeedback("عملیات ناموفق", "شما مدرس این دوره هستید.", "error");
            return false;
        }

        if (auth()->user()->hasAccessToCourse($course)) {
            newFeedback("عملیات ناموفق", "شما به دوره دسترسی دارید.", "error");
            return false;
        }


        return true;
    }

    public function downloadLinks(Course $course)
    {
        return $course->downloadLinks();
    }

}
