<?php


namespace Http;

class Route
{
    public $uri;
    public $controller;
    public $action;
    public $matches;

    public function __construct($uri, $controller, $action)
    {
        $this->uri = $uri;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function match($uri)
    {
        foreach ($this->routes as $route) {
            $action = $route->action;
            $path = preg_replace('#:([\w]+)#', '([^/]+)', $uri);
            $regex = "{^$path$}";
            if ($_SERVER['REQUEST_URI'] == $route->uri || preg_match($regex, $_SERVER['REQUEST_URI'], $matches)) {
                $this->matches[] = array_pop($matches);
                $space = "\\App\\Controller\\";
                $controller = $space . $route->controller;
                $controller_name = new $controller();
                $controller_name->$action($this->matches);
                return true;
            }
        }
        return false;
    }
}