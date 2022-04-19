<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Http\Resources\VisitorResource;
use App\Http\Resources\VisitorResourceCollection;
use App\Models\Visitor;
use App\Repositories\VisitorRepository;

class VisitorController extends Controller
{
    protected $visitorRepository;

    public function __construct(VisitorRepository $visitorRepository)
    {
        $this->visitorRepository = $visitorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return VisitorResourceCollection
     */
    public function index()
    {
        return new VisitorResourceCollection($this->visitorRepository->getAllVisitors());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVisitorRequest  $request
     * @return VisitorResource
     */
    public function store(StoreVisitorRequest $request)
    {
        $visitor = $this->visitorRepository->createVisitor($request->all());
        return new VisitorResource($visitor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return VisitorResource
     */
    public function show(Visitor $visitor)
    {
        return new VisitorResource($visitor);
    }
}
