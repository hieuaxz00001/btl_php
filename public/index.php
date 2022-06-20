<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Sessions
 */
session_start();


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'BaiViet', 'action' => 'trangchu']);

$router->add('login', ['controller' => 'Login', 'action' => 'new']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('password/reset/{token:[\da-f]+}', ['controller' => 'Password', 'action' => 'reset']);
$router->add('signup/activate/{token:[\da-f]+}', ['controller' => 'Signup', 'action' => 'activate']);
$router->add('signup', ['controller' => 'Signup', 'action' => 'newAction']);

$router->add('admin/trang-chu', ['controller' => 'BaiViet', 'action' => 'admin']);
$router->add('bai-viet/detail', ['controller' => 'BaiViet', 'action' => 'detail']);
$router->add('bai-viet/edit', ['controller' => 'BaiViet', 'action' => 'editBaiviet']);
$router->add('bai-viet/delete', ['controller' => 'BaiViet', 'action' => 'delete']);
$router->add('chu-de', ['controller' => 'BaiViet', 'action' => 'chuDe']);


$router->add('bai-viet/them-bai-viet',['controller' => 'BaiViet', 'action' => 'themBaiViet']);

$router->add('{controller}/{action}');



$router->dispatch($_SERVER['QUERY_STRING']);
