<?php

namespace Nrz\Tickets\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nrz\Common\Response\AjaxResponse;
use Nrz\Media\Services\MediaFileService;
use Nrz\Tickets\Http\Requests\ReplyRequest;
use Nrz\Tickets\Http\Requests\TicketRequest;
use Nrz\Tickets\Models\Reply;
use Nrz\Tickets\Models\Ticket;
use Nrz\Tickets\Repositories\ReplyRepo;
use Nrz\Tickets\Repositories\TicketRepo;
use Nrz\Tickets\Services\ReplyService;

class TicketController extends Controller
{

    public function index(TicketRepo $ticketRepo,Request $request)
    {
        $tickets = $ticketRepo
            ->searchByEmail($request->email)
            ->searchByName($request->name)
            ->searchByTitle($request->title)
            ->searchByDate(createDateFromJalali($request->date))
            ->searchByStatus($request->status)
            ->paginate();

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


    public function destroy(Ticket $ticket)
    {
        $hasAttachments = Reply::query()->where('ticket_id', $ticket->id)
            ->whereNotNull('media_id')->with('media')->get();
        foreach ($hasAttachments as $reply) {
            $reply->media->delete();
        }
        $ticket->delete();
        return AjaxResponse::success();
    }

    public function close(Ticket $ticket)
    {
        $ticketRepo = new TicketRepo();
        $ticketRepo->setStatus($ticket, Ticket::STATUS_CLOSE);
        return redirect(route("tickets.index"));
    }

}
