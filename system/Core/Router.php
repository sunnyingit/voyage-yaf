<?php

class Core_Router {
    protected static $groupStack = array();

    protected static $router;

    public function __construct()
    {
        self::$router = Yaf_Dispatcher::getInstance()->getRouter();
    }

    public static function group(array $attributes, Closure $callback)
    {
        self::updateGroupStack($attributes);

        call_user_func($callback, new self());
    }

    protected static function updateGroupStack(array $attributes)
    {
        if ( ! empty(self::$groupStack))
        {
            $attributes = self::mergeGroup($attributes, end(self::$groupStack));
        }

        self::$groupStack[] = $attributes;
    }

    public static function mergeGroup($new, $old)
    {
        $new['prefix'] = static::formatGroupPrefix($new, $old);

        $older = array();

        foreach ($old as $k => $v) {
            if ($k == 'prefix') {
                continue;
            }

            $older[$k] = $v;
        }

        return array_merge_recursive($older, $new);
    }

    protected static function formatGroupPrefix($new, $old)
    {
        $prefix = isset($old['prefix']) ? $old['prefix'] : '';

        if (isset($new['prefix'])) {

            return trim($prefix, '/').'/'.trim($new['prefix'], '/');
        }

        return $prefix;
    }

    public static function get($uri, $action)
    {
        return self::add('GET', $uri, $action);
    }

    public static function post($uri, $action)
    {
        return self::add('POST', $uri, $action);
    }

    public static function patch($uri, $action)
    {
        return self::add('PATCH', $uri, $action);
    }

    public static function put($uri, $action)
    {
        return self::add('PUT', $uri, $action);
    }

    public static function delete($uri, $action)
    {
        return self::add('DELETE', $uri, $action);
    }

    protected static function add($methods, $uri, $action)
    {
        $uri = trim(end(self::$groupStack)['prefix'], '/')  . '/' . $uri;

        return self::$router->addRoute($uri, self::createRoute($methods, $uri, $action));
    }

    protected static function createRoute($methods, $uri, $action)
    {
        $route = new Core_Route($methods, $uri, $action);

        return $route->getRoute();
    }

    public function resource($name, $controller, array $options = array())
    {
        foreach ($this->getResourceMethods($defaults, $options) as $m)
        {
            $this->{'addResource'.ucfirst($m)}($name, $base, $controller, $options);
        }
    }

    protected static function getResourceMethods($defaults, $options)
    {
        if (isset($options['only']))
        {
            return array_intersect($defaults, (array) $options['only']);
        }
        elseif (isset($options['except']))
        {
            return array_diff($defaults, (array) $options['except']);
        }

        return $defaults;
    }

}