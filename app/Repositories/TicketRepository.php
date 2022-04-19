<?php

namespace App\Repositories;

use App\interfaces\Repositories\TicketRepositoryInterface;
use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{

    public function getAllTickets()
    {
        return Ticket::all();
    }

    public function getAllTicketsWithEventAndVisitors()
    {
        return Ticket::with(['visitor', 'event'])->get();
    }

    public function createTicket(array $ticketData)
    {
        return Ticket::create($ticketData);
    }

    public function createAllTickets(array $ticketDataArray)
    {
        return Ticket::insert($ticketDataArray);
    }

    public function findOrFail(int $ticketId)
    {
        return Ticket::with(['visitor', 'event'])->findOrFail($ticketId);
    }

    public function getTicketById(int $ticketId)
    {
        return Ticket::find($ticketId);
    }

    public function getTicketsWithIds(array $ticketIds)
    {
        return Ticket::find($ticketIds);
    }
}
