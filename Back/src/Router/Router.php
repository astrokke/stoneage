<?php


namespace Musielak\Back\Router;


class Router
{
    private $routes = [];
    private $url;



    public function __construct(string $url)
    {
        $this->url = $url;
    }



    public function get($path, $callable)
    {
        $route = new Route($path, $callable);

        $this->routes["GET"][] = $route;
        return $route;
    }

    public function run()
    {
        if (!isset($this->routes[$_SERVER["REQUEST_METHOD"]])) {
            throw new \Exception("route pas trouver le s");
        }
        foreach ($this->routes[$_SERVER["REQUEST_METHOD"]] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        throw new \Exception("toujours pas de route le sang");
    }
}
