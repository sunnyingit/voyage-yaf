<?php

class Core_Route implements Yaf_Route_Interface {
    protected $uri = '';
    protected $methods = '';
    protected $wheres = array();
    protected $parameters = array();

    public function __construct($methods, $uri, $action)
    {
        $this->uri = $uri;
        $this->methods = (array) $methods;

        if (in_array('GET', $this->methods) && ! in_array('HEAD', $this->methods)) {
            $this->methods[] = 'HEAD';
        }

        $this->route = new Yaf_Route_Rewrite($uri, $this->parseAction($action));
    }

    public function parseAction($action) 
    {

        if (is_string($action) && strpos($action, '@')) {

            list($controller, $action) = explode('@', $action);

            return compact('controller', 'action');
        }

        return $action;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function route($request)
    {
        if ( $this->method !== '*' ) {
            if ($method != $request->getMethod()) {
                return false;
            }
        }

        return $this->route->route($request);
    }

    public function assemble(array $mvc, array $query = NULL) {
    }
}
