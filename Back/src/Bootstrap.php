<?php

namespace Stoneage\Back;

require_once __DIR__.'/../vendor/autoload.php';
use Stoneage\Back\Router\Router;

class  Bootstrap {

    public static function start(){


       ErrorHandler::handle();
       $router = new Router($_SERVER["REQUEST_URI"]);
       self::loadRoute($router);
       $router->run();


    }
       private static function loadRoute(Router $router){

        $router->get('/', function () {
            echo 'Bienvenue bande de zguegz';
        });
        
        
        $router->get('/login', function () {
            echo 'login';
        });

       }

    


}