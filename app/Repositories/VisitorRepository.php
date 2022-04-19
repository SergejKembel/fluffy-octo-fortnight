<?php

namespace App\Repositories;

use App\interfaces\Repositories\VisitorRepositoryInterface;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Collection;

class VisitorRepository implements VisitorRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllVisitors(): Collection
    {
        return Visitor::all();
    }
    /**
     * @return Collection
     */
    public function getAllVisitorsWithTickets(): Collection
    {
        return Visitor::with('tickets')->get();
    }

    public function createVisitor(array $visitorData): Visitor
    {
        return Visitor::create($visitorData);
    }

    public function createAllVisitors(array $visitorDataArray)
    {
        return Visitor::insert($visitorDataArray);
    }

    public function findOrFail(int $visitorId)
    {
        return Visitor::findOrFail($visitorId);
    }

    public function getVisitorById(int $visitorId)
    {
        return Visitor::find($visitorId);
    }
    public function getVisitorByIdWithTickets(int $visitorId)
    {
        return Visitor::with('tickets')->find($visitorId);
    }

    public function getVisitorsWithIds(array $visitorIds)
    {
        return Visitor::find($visitorIds);
    }
}
