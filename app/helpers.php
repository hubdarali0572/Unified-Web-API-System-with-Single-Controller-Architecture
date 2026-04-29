<?php


function active_class($routes, $active = 'active')
{
    foreach ((array) $routes as $route) {
        if (request()->routeIs($route)) {
            return $active;
        }
    }
    return '';
}

function is_active_route($routes)
{
    foreach ((array) $routes as $route) {
        if (request()->routeIs($route)) {
            return 'true';
        }
    }
    return 'false';
}

function show_class($routes)
{
    foreach ((array) $routes as $route) {
        if (request()->routeIs($route)) {
            return 'show';
        }
    }
    return '';
}

