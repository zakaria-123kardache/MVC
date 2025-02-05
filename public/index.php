<?php
require '../vendor/autoload.php';

// echo "am in index";

$request = $_SERVER['REQUEST_URI'];
$viewPath = '/../resources/views/pages/';

switch($request)
{
    case'/':
    case'home':
    // case'':
        require __DIR__.$viewPath.'home.php';
        break;
    case'login':
        require __DIR__.$viewPath.'login.php';
        break;
    case'register':
        require __DIR__.$viewPath.'register.php';
        break;  
        
    default :
    require __DIR__. '/../resources/views/404.php';
}





