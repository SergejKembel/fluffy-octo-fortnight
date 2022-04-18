<?php

namespace App\Repositories;

use App\interfaces\Repositories\EventRepositoryInterface;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class EventRepository implements EventRepositoryInterface
{

    /**
     * @return Collection
     */
    public function getAllEvents(): Collection
    {
        return Event::all();
    }

    public function createEvent(array $eventData): Event
    {
        return Event::create($eventData);
    }

    public function createAllEvents(array $eventDataArray)
    {
        return Event::insert($eventDataArray);
    }
    public function findOrFail(int $eventId)
    {
        return Event::findOrFail($eventId);
    }

    public function getEventById(int $eventId)
    {
        return Event::find($eventId);
    }

    public function getEventsWithIds(array $eventIds)
    {
        return Event::find($eventIds);
    }
}
