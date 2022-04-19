<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\EventRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventRepository::class, function ($app) {
            return new EventRepository();
        });
        $this->app->bind(CityRepository::class, function ($app) {
            return new CityRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
