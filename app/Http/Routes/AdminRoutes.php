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
        $router->group([
            'middleware' => ['web'],
        ], function (Registrar $router) {
            $router->get('/admin/auth', [
                'uses' => 'AdminController@login',
            ]);
        });

        $router->group([
            'middleware' => ['web', 'auth'],
        ], function (Registrar $router) {
            $router->get('/admin', [
                'as' => 'admin:home',
                'uses' => 'AdminController@home',
            ]);
            $router->get('/admin/profile', [
                'as' => 'admin:profile',
                'uses' => 'AdminController@profile',
            ]);
            $router->get('/admin/index/{model}', [
                'as' => 'admin:index',
                'uses' => 'AdminController@index',
            ]);
            $router->get('/admin/form/{model}/{id?}', [
                'as' => 'admin:form',
                'uses' => 'AdminController@form',
            ]);
            $router->get('/admin/upload/{model}/{id}', [
                'as' => 'admin:upload',
                'uses' => 'AdminController@upload',
            ]);

        });

        $router->group([
            'middleware' => ['api'],
            'namespace' => 'Api',
            'prefix' => 'api',
        ], function (Registrar $router) {
            $router->post('/auth/signin', [
                'uses' => 'AuthController@signIn',
            ]);
        });

        $router->group([
            'middleware' => ['api', 'auth'],
            'namespace' => 'Api',
            'prefix' => 'api',
        ], function (Registrar $router) {
            $router->post('/auth/signout', [
                'uses' => 'AuthController@signOut',
            ]);
            $router->post('/create/{model}', [
                'uses' => 'ModelController@create',
            ]);
            $router->get('/search/{model}', [
                'uses' => 'ModelController@search',
            ]);

            $router->get('/{model}/{id?}', [
                'uses' => 'ModelController@get',
            ]);

            $router->put('/update/{model}/{id}', [
                'uses' => 'ModelController@update',
            ]);
            $router->delete('/delete/{model}/{id}', [
                'uses' => 'ModelController@delete',
            ]);
            $router->post('/upload/{model}/{id}', [
                'uses' => 'ModelController@upload',
            ]);
        });
    }
}
