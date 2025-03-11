<?php

namespace Musielak\Back;

use Musielak\Back\Router\Router;

class  bootstrapp {

    public static function start(){

       require_once __DIR__.'/../vendor/autoload.php';

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