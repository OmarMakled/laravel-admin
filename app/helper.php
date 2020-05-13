<?php

/**
 * Generate the URL to a named route.
 *
 * @param  array|string  $name
 * @param  mixed  $parameters
 * @param  bool  $absolute
 * @return string
 */
function __r($name, $parameters = [], $absolute = true)
{
    $parameters = ['locale' => app()->getLocale()] + $parameters;

    return app('url')->route($name, $parameters, $absolute);
}
