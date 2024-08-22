<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router {
    protected $routes = [];

    /**
     * Add a new route
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    public function registerRoute($method, $uri, $action) {
        list($controller, $controllerMethod) = explode('@', $action);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }

    /**
     * Add a GET route
     * 
     * @param string $uri
     * @param string $action
     * @return void
     */
    public function get($uri, $action) {
        $this->registerRoute('GET', $uri, $action);
    }

    /**
     * Add a POST route
     * 
     * @param string $uri
     * @param string $action
     * @return void
     */
    public function post($uri, $action) {
        $this->registerRoute('POST', $uri, $action);
    }

    /**
     * Add a PUT route
     * 
     * @param string $uri
     * @param string $action
     * @return void
     */
    public function put($uri, $action) {
        $this->registerRoute('PUT', $uri, $action);
    }

    /**
     * Add a DELETE route
     * 
     * @param string $uri
     * @param string $action
     * @return void
     */
    public function delete($uri, $action) {
        $this->registerRoute('DELETE', $uri, $action);
    }

    /**
     * Route the request
     * 
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route($uri, $method) {
        foreach ($this->routes as $route) {
            if($route['uri'] === $uri && $route['method'] === $method ) {
                // Extract controller and controller method
                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                // Instatiate the controller and call the method
                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();
                return;
            }
        }

        ErrorController::notFound();
    }
}