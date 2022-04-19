<?php

namespace App\Repositories;

use App\interfaces\Repositories\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class CityRepository implements CityRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllCities(): Collection
    {
        return City::all();
    }

    public function createCity(array $cityData): City
    {
        return City::create($cityData);
    }

    public function createAllCities(array $cityDataArray)
    {
        return City::insert($cityDataArray);
    }

    public function findOrFail(int $cityId)
    {
        return City::findOrFail($cityId);
    }

    public function getCityById(int $cityId)
    {
        return City::find($cityId);
    }

    public function getCitiesWithIds(array $cityIds)
    {
        return City::find($cityIds);
    }
}
