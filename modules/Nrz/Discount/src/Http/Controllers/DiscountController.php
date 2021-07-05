<?php

namespace Nrz\Discount\Http\Controllers;

use App\Http\Controllers\Controller;
use Nrz\Common\Response\AjaxResponse;
use Nrz\Course\Model\Course;
use Nrz\Course\Repo\CourseRepo;
use Nrz\Discount\Http\Requests\DiscountRequest;
use Nrz\Discount\Models\Discount;
use Nrz\Discount\Repositories\DiscountRepo;
use Nrz\Discount\Services\DiscountService;

class DiscountController extends Controller
{

    public function index(CourseRepo $courseRepo, DiscountRepo $discountRepo)
    {
        $courses = $courseRepo->getCourseHasSuccessStatus();
        $discounts = $discountRepo->getAllDiscount();
        return view("Discount::index", compact('courses', 'discounts'));
    }


    public function store(DiscountRequest $request, DiscountRepo $discountRepo)
    {
        $discountRepo->store($request->all());

        newFeedback("موفقیت آمیز", "تخفیف با موفقیت ایجاد شد", "success");
        return redirect(route("discounts.index"));

    }


    public function edit(Discount $discount, CourseRepo $courseRepo)
    {
        $courses = $courseRepo->getCourseHasSuccessStatus();
        return view("Discount::edit", compact('discount', 'courses'));
    }


    public function update(DiscountRequest $request, Discount $discount, DiscountRepo $discountRepo)
    {
        $discountRepo->update($discount, $request->all());
        newFeedback("موفقیت آمیز", "تخفیف با موفقیت ویرایش  شد", "success");
        return redirect(route("discounts.index"));
    }

    public function check($discountCode, Course $course, DiscountRepo $discountRepo)
    {
        $validDiscount = $discountRepo->checkCodeDiscountIsValid($discountCode, $course->id);
        if ($validDiscount) {
            $percentDiscount = $validDiscount->percent;
            $amountDiscount = DiscountService::getAmountDiscount($course->getFinalPrice(), $percentDiscount);
            $payableAmount = $course->getFinalPrice() - $amountDiscount;
            return response([
                "status" => "valid",
                "percentDiscount" => $percentDiscount,
                "amountDiscount" => $amountDiscount,
                "payableAmount" => $payableAmount,
            ], 200);

        } else {
            return response([
                "status" => "invalid"
            ], 422);
        }

    }


    public function destroy(Discount $discount)
    {
        $discount->delete();
        return AjaxResponse::success();
    }
}
