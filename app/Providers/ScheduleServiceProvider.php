<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider;
use Modules\Schedules\Repositories\ScheduleInterface;
use Modules\Schedules\Repositories\ScheduleRepository;

class ScheduleServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(ScheduleInterface::class, ScheduleRepository::class);
    }

    public function boot()
    {
//        return parent::boot(); // TODO: Change the autogenerated stub
    }
}