<?php
require '../helpers.php';

$routes = [
    '/'                 => 'controllers/home.php',
    '/listings'         => 'controllers/listings/index.php',
    '/listings/create'  => 'controllers/listings/create.php',
    '404'               => 'controllers/error/404.php'
];

$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace('/workopia', '', $uri);
// inspectAndDie($uri);

if (array_key_exists($uri, $routes)) {
    require(basePath($routes[$uri]));
} else {
    require basePath($routes['404']);
}