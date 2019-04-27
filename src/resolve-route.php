<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 05/04/2019
 * Time: 13:06
 */

function resolve($route)
{
    $path = $_SERVER['PATH_INFO'] ?? '/';

    $route = '/^' . str_replace('/', '\/', $route) . '$/';

    if (preg_match($route, $path, $params)) {
        return $params;
    }
    return false;
}