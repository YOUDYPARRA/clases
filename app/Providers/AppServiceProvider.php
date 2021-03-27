<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;


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
        Inertia::share([

            'errors' => function () {

                return Session::get('errors')

                    ? Session::get('errors')->getBag('default')->getMessages()

                    : (object) [];

            },

        ]);

  

        Inertia::share('flash', function () {

            return [

                'message' => Session::get('message'),

            ];

        });
        // Inertia::share('auth.user',function(){ return Auth::user();});

    }
}
