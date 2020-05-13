<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class FrontRoutes
{
    /**
     * Define the setup routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => 'web',
            'prefix' => '{locale}',
            'where' => ['locale' => config('app.locales')],
        ], function (Registrar $router) {
            // $router->get('/', [
            //     'as' => 'front:home',
            //     'uses' => 'FrontController@home',
            // ]);
            // $router->get('/auth/profile', [
            //     'middleware' => 'auth',
            //     'as' => 'auth:profile',
            //     'uses' => 'FrontController@profile',
            // ]);
        });
    }
}
