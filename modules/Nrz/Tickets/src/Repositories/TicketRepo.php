<?php

namespace Nrz\Tickets\Repositories;

use Nrz\Tickets\Models\Ticket;

class TicketRepo
{
    public function paginate()
    {
        return Ticket::query()->latest()->paginate();
    }

    public function store($title)
    {
        return Ticket::query()->create([
            "title" => $title,
            "user_id" => auth()->user()->id,
        ]);
    }

    public function setStatus(Ticket $ticket, $status)
    {
        return $ticket->update(["status" => $status]);
    }
}
