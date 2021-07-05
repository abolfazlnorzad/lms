<?php

namespace Nrz\Course\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;
use Nrz\Course\Database\Seeds\RolePermissionTableSeeder;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/courses_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/season_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/lessons_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Course');
        DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang',"Courses");

    }

    public function boot()
    {
        config()->set('sidebar.items.courses', [
            'icon' => 'i-courses',
            'title' => 'دوره ها',
            'url' => route('courses.index'),
            'permission'=>'teach'
        ]);
    }
}
