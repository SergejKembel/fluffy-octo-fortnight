<?php

namespace App\interfaces\Repositories;

interface TicketRepositoryInterface
{
    public function getAllTickets();
    public function getAllTicketsWithEventAndVisitors();
    public function createTicket(array $ticketData);
    public function createAllTickets(array $ticketDataArray);
    public function findOrFail(int $ticketId);
    public function getTicketById(int $ticketId);
    public function getTicketsWithIds(array $ticketIds);
}
