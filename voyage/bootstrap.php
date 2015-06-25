<?php

// 框架初始化
Core_Bootstrap::init();

class Bootstrap extends Yaf_Bootstrap_Abstract
{
    public function _initView(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->setView(Core_View::getInstance());
    }

     public function _initRoute(Yaf_Dispatcher $dispatcher)
     {
        $router = $dispatcher->getRouter();
       $route = new Yaf_Route_Rewrite('v1/product/:ident',array('controller' => 'Main','action' => 'echo'));
       
       //使用路由器装载路由协议
       $router->addRoute('product', $route);
    }
}