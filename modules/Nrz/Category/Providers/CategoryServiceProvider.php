<?php

namespace Nrz\Category\Providers;
use Illuminate\Support\ServiceProvider;
class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Category');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/Category_routes.php');
        config()->set('sidebar.items.categories',[
            "icon"=>"i-categories",
            "title"=>"دسته بندی ها",
            "url"=>route('categories.index'),
            'permission'=>'show-category'
        ]);
    }
}
