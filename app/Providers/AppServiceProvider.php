<?php

namespace App\Providers;

use App\DataTables\Factory\DataTable;
use App\DataTables\Factory\DataTableInterface;
use App\Validator\ValidatingMiddleware;
use Illuminate\Contracts\Bus\Dispatcher;
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
        $this->app->bind(DataTableInterface::class, function ($app) {
            return new DataTable($app->make('request'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $dispatcher)
    {
        $dispatcher->pipeThrough([ValidatingMiddleware::class]);
    }
}
