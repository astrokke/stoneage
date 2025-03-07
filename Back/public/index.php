<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Musielak\Back\ErrorHandler;

use Musielak\Back\Router\Router;

ErrorHandler::handle();



$router = new Router($_SERVER["REQUEST_URI"]);
$router->get('/', function () {
    echo 'Bienvenue bande de zguegz';
});


$router->get('/login', function () {
    echo 'login';
});

$router->run();
