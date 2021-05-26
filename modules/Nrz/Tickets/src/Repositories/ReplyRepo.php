<?php


namespace Nrz\Tickets\Repositories;


use Nrz\Tickets\Models\Reply;

class ReplyRepo
{
    public function store($ticketId, $body, $mediaId)
    {
        return Reply::query()->create([
            "user_id" => auth()->user()->id,
            "body" => $body,
            "media_id" => $mediaId,
            "ticket_id" => $ticketId
        ]);
    }
}
