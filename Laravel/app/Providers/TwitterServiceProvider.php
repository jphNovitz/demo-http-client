<?php

namespace App\Providers;

use App\Contracts\TwitterGetterInterface;
use App\Contracts\TwitterPresenterInterface;
use App\Services\TwitterGetter;
use App\Services\TwitterPresenter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class TwitterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind( TwitterGetterInterface::class, TwitterGetter::class);
       $this->app->bind( TwitterPresenterInterface::class, TwitterPresenter::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
