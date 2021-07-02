<?php

namespace Nrz\Tickets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Nrz\Media\Models\Media;
use Nrz\User\Model\User;

class Reply extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "ticket_replies";

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function attachmentLink()
    {
        return URL::temporarySignedRoute('media.download',now()->addDay(),['media'=>$this->media_id]);
    }

}
