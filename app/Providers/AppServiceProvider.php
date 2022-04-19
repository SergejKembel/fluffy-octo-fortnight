<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\TicketRepository;
use App\Repositories\VisitorRepository;
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
        $this->app->bind(VisitorRepository::class, function ($app) {
            return new VisitorRepository();
        });
        $this->app->bind(CityRepository::class, function ($app) {
            return new CityRepository();
        });
        $this->app->bind(VisitorRepository::class, function ($app) {
            return new VisitorRepository();
        });
        $this->app->bind(TicketRepository::class, function ($app) {
            return new TicketRepository();
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
