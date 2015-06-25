<?php

class Core_Router {

    public function __construct()
    {
        $this->router = Yaf_Dispatcher::getInstance()->getRouter();
    }

    public function get($uri, $action)
    {
        return $this->add('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        return $this->add('POST', $uri, $action);
    }

    public function patch($uri, $action)
    {
        return $this->add('PATCH', $uri, $action);
    }

    public function put($uri, $action)
    {
        return $this->add('PUT', $uri, $action);
    }

    public function delete($uri, $action)
    {
        return $this->add('DELETE', $uri, $action);
    }

    protected function add($methods, $uri, $action)
    {
        return $this->router->addRoute('product', $this->createRoute($methods, $uri, $action));
    }

    protected function createRoute($methods, $uri, $action)
    {
        return new Yaf_Route_Rewrite($uri, $action);
    }   
}