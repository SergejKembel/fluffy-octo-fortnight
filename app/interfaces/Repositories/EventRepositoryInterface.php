<?php

namespace App\interfaces\Repositories;

interface EventRepositoryInterface
{
    public function getAllEvents();
    public function getAllEventsWithCities();
    public function createEvent(array $eventData);
    public function createAllEvents(array $eventDataArray);
    public function findOrFail(int $eventId);
    public function getEventById(int $eventId);
    public function getEventByIdWithCity(int $eventId);
    public function getEventsWithIds(array $eventIds);
}
