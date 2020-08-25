<?php

namespace App;

class Router
{
    private $routeMenu = [];

    public function get(Route $route) {
        $this->routeMenu[] = $route;
    }

    public function dispatch() {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        if ($uri === '/index.php') {
            $uri = '/';
        }

        //проверка на совпадение $URI с базой route
        foreach ($this->routeMenu as $route){
            if ($route->match($_SERVER['REQUEST_METHOD'], $uri)) {
                $route->run($uri);
                return;
            }
        }

        throw new NotFoundException();
    }
}