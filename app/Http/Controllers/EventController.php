<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventResourceCollection;
use App\Models\Event;
use App\Repositories\EventRepository;

class EventController extends Controller
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return EventResourceCollection
     */
    public function index()
    {
        return new EventResourceCollection($this->eventRepository->getAllEvents());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return EventResource
     */
    public function store(StoreEventRequest $request)
    {
        $event = $this->eventRepository->createEvent($request->all());
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return EventResource
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }
}
