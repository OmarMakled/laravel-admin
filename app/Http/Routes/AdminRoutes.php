<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class AdminRoutes
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
        $this->web($router);
        $this->api($router);
    }

    private function web(Registrar $router)
    {
        $router->group([
            'middleware' => ['web'],
            'prefix' => '/admin',
        ], function (Registrar $router) {
            $router->get('/auth', [
                'uses' => 'AdminController@login',
            ]);
            $router->get('/', [
                'middleware' => ['auth'],
                'as' => 'admin:home',
                'uses' => 'AdminController@home',
            ]);
            $router->get('/profile', [
                'middleware' => ['auth'],
                'as' => 'admin:profile',
                'uses' => 'AdminController@profile',
            ]);
            $router->get('/index/{model}', [
                'middleware' => ['auth'],
                'as' => 'admin:index',
                'uses' => 'AdminController@index',
            ]);
            $router->get('/form/{model}/{id?}', [
                'middleware' => ['auth'],
                'as' => 'admin:form',
                'uses' => 'AdminController@form',
            ]);
            $router->get('/upload/{model}/{id}', [
                'middleware' => ['auth'],
                'as' => 'admin:upload',
                'uses' => 'AdminController@upload',
            ]);
        });
    }

    private function api(Registrar $router)
    {
        $router->group([
            'middleware' => ['api'],
            'namespace' => 'Api',
            'prefix' => 'api',
        ], function (Registrar $router) {
            $router->post('/auth/signin', [
                'uses' => 'AuthController@signIn',
            ]);
            $router->post('/auth/signout', [
                'middleware' => ['auth'],
                'uses' => 'AuthController@signOut',
            ]);
            $router->put('/auth/profile', [
                'middleware' => ['auth'],
                'uses' => 'AuthController@updateProfile',
            ]);
            $router->post('/create/{model}', [
                'middleware' => ['auth'],
                'uses' => 'ModelController@create',
            ]);
            $router->get('/search/{model}', [
                'middleware' => ['auth'],
                'uses' => 'ModelController@search',
            ]);

            $router->get('/{model}/{id?}', [
                'middleware' => ['auth'],
                'uses' => 'ModelController@get',
            ]);

            $router->put('/update/{model}/{id}', [
                'middleware' => ['auth'],
                'uses' => 'ModelController@update',
            ]);
            $router->delete('/delete/{model}/{id}', [
                'middleware' => ['auth'],
                'uses' => 'ModelController@delete',
            ]);
            $router->post('/upload/{model}/{id}', [
                'middleware' => ['auth'],
                'uses' => 'ModelController@upload',
            ]);
        });
    }
}
