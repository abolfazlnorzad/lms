<?php

namespace Nrz\Tickets\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Nrz\Media\Services\MediaFileService;
use Nrz\Tickets\Models\Ticket;
use Nrz\Tickets\Repositories\ReplyRepo;
use Nrz\Tickets\Repositories\TicketRepo;

class ReplyService
{
    public static function store(Ticket $ticket, $reply, $attachment = null): Model
    {
        $replyRepo = new ReplyRepo();
        $ticketRepo = new TicketRepo();
        $media_id = null;
        if ($attachment && ($attachment instanceof UploadedFile)) {
            $media_id = MediaFileService::privateUpload($attachment)->id;
        }
        $newReply = $replyRepo->store($ticket->id, $reply, $media_id);

        if ($newReply->user_id != $ticket->user_id) {
            $ticketRepo->setStatus($ticket, Ticket::STATUS_REPLIED);
        } else {
            $ticketRepo->setStatus($ticket, Ticket::STATUS_OPEN);
        }

        return $newReply;
    }
}
