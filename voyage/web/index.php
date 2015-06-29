<?php

define('APP_PATH', dirname(__DIR__) . '/');
define('SYS_PATH', dirname(APP_PATH) . '/system/');
define('VENDOR_PATH', dirname(APP_PATH) . '/vendor/');

require_once  VENDOR_PATH .'/autoload.php';
require_once SYS_PATH .'/Core/App.php';

$app = App::getInstance(new Yaf_Application(APP_PATH . 'conf/app.ini'));

$app->bootstrap()->run();