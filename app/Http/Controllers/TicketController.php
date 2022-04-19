<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketResourceCollection;
use App\Models\Ticket;
use App\Repositories\TicketRepository;

class TicketController extends Controller
{
    private TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return TicketResourceCollection
     */
    public function index()
    {
        return new TicketResourceCollection($this->ticketRepository->getAllTicketsWithEventAndVisitors());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTicketRequest $request
     * @return TicketResource
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = $this->ticketRepository->createTicket($request->all());
        $ticket->load(['event', 'visitor']);
        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return TicketResource
     */
    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket);
    }
}
