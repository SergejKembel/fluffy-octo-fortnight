<?php

namespace App\interfaces\Repositories;

interface CityRepositoryInterface
{
    public function getAllCities();
    public function createCity(array $cityData);
    public function createAllCities(array $cityDataArray);
    public function findOrFail(int $cityId);
    public function getCityById(int $cityId);
    public function getCitiesWithIds(array $cityIds);
}
