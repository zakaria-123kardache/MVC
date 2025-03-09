<?php

use App\Controller\IndexController;
use App\Routes\Router;

require __DIR__. '/../vendor/autoload.php';
session_start();

$router = new Router($_SERVER['REQUEST_URI']);



// routes 
$router->get('/', [IndexController::class, 'index']);
$router->get('/about',[IndexController::class, 'about']);




$router->run();
