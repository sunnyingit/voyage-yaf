<?php

use Illuminate\Support\Collection;

class App extends Collection {
    protected $app;
    protected static $instance = '';

    public function __construct(Yaf_Application $app)
    {
        $this->app = $app;
    }

    public function __call($method, $args)
    {
        return call_user_func_array(array($this->app, $method), $args);
    }

    public static function getInstance(Yaf_Application $app)
    {
        if (! self::$instance) {
            self::$instance = new self($app);
        }

        return self::$instance;
    }
}