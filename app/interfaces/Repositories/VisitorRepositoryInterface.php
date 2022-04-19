<?php

namespace App\interfaces\Repositories;

interface VisitorRepositoryInterface
{
    public function getAllVisitors();
    public function getAllVisitorsWithTickets();
    public function createVisitor(array $visitorData);
    public function createAllVisitors(array $visitorDataArray);
    public function findOrFail(int $visitorId);
    public function getVisitorById(int $visitorId);
    public function getVisitorByIdWithTickets(int $visitorId);
    public function getVisitorsWithIds(array $visitorIds);
}
