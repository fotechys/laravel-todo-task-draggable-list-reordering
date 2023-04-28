<?php

namespace App\Providers;
use App\Models\Project;

use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['tasks.fields', 'tasks.index'], function ($view) {
            $projectItems = Project::pluck('project_name','id')->toArray();
            $view->with('projectItems', $projectItems);
        });
        //
    }
}
