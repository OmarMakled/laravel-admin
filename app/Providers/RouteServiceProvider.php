<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            $path = app_path('Http/Routes');
            $AllFileIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            $PhpFileIterator = new \RegexIterator($AllFileIterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);

            foreach ($PhpFileIterator as $file => $object) {
                $class = substr($file, strlen($path));
                $class = str_replace('/', '\\', $class);
                $class = substr($class, 0, -4);
                $routes = $this->app->make("App\\Http\\Routes${class}");

                $router->group([], function (Router $router) use ($routes) {
                    $routes->map($router);
                });
            }
        });
    }
}
