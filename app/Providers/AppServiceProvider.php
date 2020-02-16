<?php

namespace App\Providers;

use \App\Categories;

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
        //membuat dinamik widget agar tidak load berulang2
  view()->composer('include.sidebaradmin', function($view)
  {

   $kategoriy = Categories::where('flag_active', 'Y')->get();
   
   $view->with('kategorimenu',$kategoriy);
   
  });
    }
}
