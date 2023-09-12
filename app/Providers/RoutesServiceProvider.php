<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider;
use Modules\Routes\Repositories\RouteInterface;
use Modules\Routes\Repositories\RouteRepository;

class RoutesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RouteInterface::class,RouteRepository::class);
    }

}