<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Resources\CityResource;
use App\Http\Resources\CityResourceCollection;
use App\Models\City;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    private CityRepository $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return CityResourceCollection
     */
    public function index()
    {
        return new CityResourceCollection($this->cityRepository->getAllCities());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCityRequest  $request
     * @return CityResource
     */
    public function store(StoreCityRequest $request)
    {
        $city = $this->cityRepository->createCity($request->all());
        return new CityResource($city);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return CityResource
     */
    public function show(City $city)
    {
        return new CityResource($city);
    }
}
