<?php

namespace Nrz\Course\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\Category\Model\Category;
use Nrz\Course\Repo\CourseRepo;
use Nrz\Discount\Models\Discount;
use Nrz\Discount\Repositories\DiscountRepo;
use Nrz\Media\Models\Media;
use Nrz\Payment\Models\Payment;
use Nrz\User\Model\User;

class Course extends Model
{
    use HasFactory;

//    use Sluggable;
//
//    public function sluggable()
//    {
//        return [
//            'slug' => [
//                'source' => 'title'
//            ]
//        ];
//    }

//    public function getRouteKeyName()
//    {
//        return "slug";
//    }

    protected $guarded = [];


    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_FREE, self::TYPE_CASH];

    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED, self::STATUS_LOCKED];

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];


    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function formattedDuration()
    {
        $duration = (new CourseRepo())->getDuration($this->id);

        $h = round($duration / 60) < 10 ? '0' . round($duration / 60) : round($duration / 60);
        $m = $duration % 60;
        $s = ":00";
        return $h . ':' . $m . $s;
    }

    public function path()
    {
        return route('singleCourse', $this->id . '-' . $this->slug);
    }

    public function lessonsCount()
    {
        return (new CourseRepo())->getLessonCount($this->id);
    }

    public function shortUrl()
    {
        return route('singleCourse', $this->id);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function getFormattedPrice()
    {
        return number_format($this->price);
    }

    public function getDiscountPercent()
    {
        $discountRepo = new DiscountRepo();
        $percent = 0;
        $specificDiscount = $discountRepo->getCourseBiggerDiscount($this->id);
        if ($specificDiscount) $percent = $specificDiscount->percent;
        $globalDiscount = $discountRepo->getGlobalBiggerDiscount();
        if ($globalDiscount && $globalDiscount->percent > $percent) $percent = $globalDiscount->percent;
        return $percent;
    }

    public function getDiscountAmount()
    {
        return $this->price * ((float)("0." . $this->getDiscountPercent()));
    }

    public function getFinalPrice()
    {
        return $this->price - $this->getDiscountAmount();
    }

    public function getFormattedFinalPrice()
    {
        return number_format($this->price - $this->getDiscountAmount());
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function payment()
    {
        return $this->payments()->latest()->first();
    }

    public function downloadLinks()
    {
        $lessons = resolve(CourseRepo::class)->getCourseLessonsLink($this);
        $links = [];
        foreach ($lessons as $lesson) {
            $links[] = $lesson->downloadLink();
        }
        return implode("<br>", $links);
    }

    public function discounts()
    {
        return $this->morphToMany(Discount::class, "discountable");
    }

}
