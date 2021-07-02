<?php

namespace Nrz\Tickets\Repositories;

use Nrz\Tickets\Models\Ticket;

class TicketRepo
{

    private $query;

    public function __construct()
    {
        $this->query = Ticket::query();
    }

    public function paginate($number = 15)
    {
        return $this->query->latest()->paginate($number);
    }

    public function store($title)
    {
        return $this->query->create([
            "title" => $title,
            "user_id" => auth()->user()->id,
        ]);
    }

    public function setStatus(Ticket $ticket, $status)
    {
        return $ticket->update(["status" => $status]);
    }

    public function searchByEmail($email)
    {
        if (!is_null($email)) {
            $this->query->whereHas('user', function ($user) use ($email) {
                return $user->where('email', "LIKE", "%{$email}%");
            });
        }

        return $this;
    }

    public function searchByName($name)
    {
        if (!is_null($name)) {
            $this->query->whereHas('user', function ($user) use ($name) {
                return $user->where('name', 'LIKE', "%{$name}%");
            });
        }

        return $this;
    }

    public function searchByTitle($title)
    {
        if (!is_null($title)) {
            $this->query->where('title', 'LIKE', "%{$title}%")->get();
        }
        return $this;
    }

    public function searchByDate($date)
    {
        if (!is_null($date)) {
            $this->query->whereDate('created_at', '=', $date)->get();
        }


        return $this;
    }

    public function searchByStatus($status)
    {
        if (!is_null($status)) {
            $this->query->where('status', $status)->get();
        }
        return $this;
    }

}
