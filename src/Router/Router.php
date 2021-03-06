<?php

namespace Masterclass\Router;

use Masterclass\Router\Route\RouterInterface;

class Router
{
    protected $serverVars;

    protected $routes = [];

    public function __construct(array $serverVars, array $routes = [])
    {
        $this->serverVars = $serverVars;
        foreach ($routes as $route){
            $this->addRoute($route);
        }
    }

    public function addRoute(RouterInterface $route)
    {
        $this->routes[] = $route;
    }

    public function findMatch()
    {
        $path = parse_url($this->serverVars['REQUEST_URI'], PHP_URL_PATH);
        foreach ($this->routes as $route)
        {
            if ($route->matchRoute($path, $this->serverVars['REQUEST_METHOD'])) {
                return $route;
            }
        }
        return false;
    }
}