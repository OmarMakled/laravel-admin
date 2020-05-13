<?php

namespace App\Services;

use Illuminate\Http\Request;

class RoutingService
{

    public function redirectTo(Request $request)
    {

    }

    public function adminForm(string $model, string $id = null)
    {
        $routes = [];
        $locales = explode('|', config('app.locales'));

        foreach ($locales as $locale) {
            $routes[] = route('admin:form', [
                $model,
                $id,
                'locale' => $locale,
            ]);
        }

        return $routes;
    }
}
