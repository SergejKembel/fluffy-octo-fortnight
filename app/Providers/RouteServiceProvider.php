<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\EventRepository;
use App\Repositories\TicketRepository;
use App\Repositories\VisitorRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * @var EventRepository
     */
    protected $eventRepository;

    /**
     * @var CityRepository
     */
    protected $cityRepository;

    /**
     * @var VisitorRepository
     */
    private mixed $visitorRepository;
    /**
     * @var TicketRepository
     */
    private mixed $ticketRepository;


    public function __construct($app)
    {
        parent::__construct($app);
        $this->eventRepository = app()->make(EventRepository::class);
        $this->cityRepository = app()->make(CityRepository::class);
        $this->visitorRepository = app()->make(VisitorRepository::class);
        $this->ticketRepository = app()->make(TicketRepository::class);
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api.php'));
        });

        Route::bind('event', fn($value) => $this->eventRepository->findOrFail($value));
        Route::bind('city', fn($value) => $this->cityRepository->findOrFail($value));
        Route::bind('visitor', fn($value) => $this->visitorRepository->findOrFail($value));
        Route::bind('ticket', fn($value) => $this->ticketRepository->findOrFail($value));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
