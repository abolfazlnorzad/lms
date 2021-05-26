<?php

namespace Nrz\Tickets\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nrz\Media\Services\MediaFileService;
use Nrz\Tickets\Http\Requests\ReplyRequest;
use Nrz\Tickets\Http\Requests\TicketRequest;
use Nrz\Tickets\Models\Ticket;
use Nrz\Tickets\Repositories\ReplyRepo;
use Nrz\Tickets\Repositories\TicketRepo;
use Nrz\Tickets\Services\ReplyService;

class TicketController extends Controller
{

    public function index(TicketRepo $ticketRepo)
    {
        $tickets = $ticketRepo->paginate();
        return view("Tickets::index", compact('tickets'));
    }


    public function create()
    {
        return view("Tickets::create");
    }


    public function store(TicketRequest $request, TicketRepo $ticketRepo)
    {
        $ticket = $ticketRepo->store($request->title);
        ReplyService::store($ticket, $request->body, $request->attachment);

        return redirect(route('tickets.index'));
    }


    public function show(Ticket $ticket)
    {
        $ticket = $ticket->load('replies');
        return view("Tickets::show", compact('ticket'));
    }

    public function reply(Ticket $ticket, ReplyRepo $replyRepo, ReplyRequest $request)
    {
        ReplyService::store($ticket, $request->body, $request->attachment);

        return redirect(route("tickets.show", $ticket->id));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function close(Ticket $ticket)
    {
        $ticketRepo = new TicketRepo();
        $ticketRepo->setStatus($ticket, Ticket::STATUS_CLOSE);
        return redirect(route("tickets.index"));
    }

}
