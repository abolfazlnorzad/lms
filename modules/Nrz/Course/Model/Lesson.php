<?php

namespace Nrz\Course\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Nrz\Media\Models\Media;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = [];
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];

    const STATUS_OPENED = 'opened';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_OPENED, self::STATUS_LOCKED];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function path()
    {
        return $this->course->path() . "?lesson=l-" . $this->id . "-" . $this->slug;
    }

    public function downloadLink()
    {
        return URL::temporarySignedRoute('media.download', now()->addDay(), ['media' => $this->media_id]);
    }

}
