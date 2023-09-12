<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider;
use Modules\Buses\Repositories\busInterface;
use Modules\Buses\Repositories\busRepository;

class BusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(busInterface::class, busRepository::class);
    }

}