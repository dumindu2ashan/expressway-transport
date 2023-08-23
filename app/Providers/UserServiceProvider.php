<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider;
use Modules\Users\Repositories\UserInterface;
use Modules\Users\Repositories\UserRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    public function boot()
    {
//        return parent::boot(); // TODO: Change the autogenerated stub
    }


}