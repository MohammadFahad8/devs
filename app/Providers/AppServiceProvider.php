<?php

namespace App\Providers;

use App\Models\Books;
use App\Models\Zebra;
use App\Contracts\BookContract;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if($_SERVER['REQUEST_URI']=='/zebras/')
        {
            $this->app->bind(BookContract::class, Zebra::class);
        }else
        {
            $this->app->bind(BookContract::class, Books::class);
        }
    }
}
