<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class ApiRoutes
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
            'middleware' => 'api',
            'namespace' => 'Api',
            'prefix' => 'api',
        ], function (Registrar $router) {
            // $router->get('/listings', [
            //     'uses' => 'ListingController@getList',
            // ]);
            // $router->post('/auth/signup', [
            //     'uses' => 'AuthController@signUp',
            // ]);
            // $router->patch('/auth/profile', [
            //     'middleware' => 'auth',
            //     'uses' => 'AuthController@profile',
            // ]);
        });
    }
}
