<?php

namespace Nrz\User\Model;

use App\Notifications\ResetPasswordRequestNotification;
use App\Notifications\VerifyEamilNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Nrz\Acl\Model\Permission;
use Nrz\Acl\Model\Role;
use Nrz\Course\Model\Course;
use Nrz\Course\Model\Lesson;
use Nrz\Course\Model\Season;
use Nrz\Media\Models\Media;
use Nrz\Payment\Models\Payment;
use Nrz\Payment\Models\Settlement;
use Nrz\Tickets\Models\Reply;
use Nrz\Tickets\Models\Ticket;


class User extends Authenticatable implements MustVerifyEmail
{


    use HasFactory, Notifiable;


    const STATUS_ACTIVE = "active";
    const STATUS_INACTIVE = "inactive";
    const STATUS_BAN = "ban";
    public static $statuses = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_BAN
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEamilNotification());

    }


    public function sendResetPasswordRequest()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function isStaff()
    {
        return $this->is_staff;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roles)
    {
        return !!$roles->intersect($this->roles)->all();
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains($permission) || $this->hasRole($permission->roles);
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }


    public function profilePath()
    {
        return $this->username ? route('viewProfile', $this->username) : route('viewProfile', 'username');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function hasAccessToCourse(Course $course)
    {

        // TODO Manage course can access to any Course can()
        if (
            $this->id == $course->teacher_id
            || $course->students->contains($this->id)
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function AccessToFreeLesson(Lesson $lesson)
    {
        if ($lesson->free) {
            return true;
        } else {
            return false;
        }
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, "buyer_id");

    }

    public function purchases()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    public function studentsCount()
    {

        return DB::table('courses')
            ->where('teacher_id', $this->id)
            ->join("course_user", "courses.id", "=", "course_user.course_id")
            ->count();
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketReplies()
    {
        return $this->hasMany(Reply::class);
    }

}
