<?php

class Core_Route extends Yaf_Route {
    public $routes = '';

    public function __construct($method, $uri, $action)
    {
        $route = parent::__construct($uri, $action);

        $this->routes[$method][$uri] = $route;
    }
}
