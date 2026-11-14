<?php

namespace App\Providers;

use App\Models\Institute;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;


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
	    View::composer('website.layout.*', function ($view) {
		    $institute_slug = Route::current()->parameter('institute'); // Get the slug from the current route
		    if( isset($institute_slug) && ! empty($institute_slug)) {
			    $view->with('institute', $institute_slug);
		    }

		    $user_slug = Route::current()->parameter('user'); // Get the slug from the current route
		    if( isset($user_slug) && ! empty($user_slug)) {
			    $view->with('user', $user_slug);
		    }

	    });
    }
}
