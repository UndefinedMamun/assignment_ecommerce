<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('master', function($view){
           $published_category = DB::table('tbl_category')
                ->where('publication_status', 1)
                ->get();
            $view->with('published_category',$published_category); 
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
