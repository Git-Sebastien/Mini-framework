<?php 

namespace Http;

use Http\Route;

class Router{
    public $controller_name;
    public $action;
    public $routes = [];
    public $route_name = [];

    public function get($uri,$controller_name,$action)
    {
       $routes = new Route($uri,$controller_name,$action);
            $this->routes[] = $routes; 
            return $this;
    }

    public function post($uri,$controller_name,$action)
    {
       $routes = new Route($uri,$controller_name,$action);
            $this->routes[] = $routes;   
            return $this; 
    }
    
    /**
     * Add the uri to the array route
     *
     * @param  mixed $route
     * @return void
     */

    public function name(string $name): Router
    {
        $this->route_name[] = $name;

        return $this;
    }

    public function run()
    {
        foreach($this->routes as $route) {
            $action = $route->action;
            if($_SERVER['REQUEST_URI'] == '/'.$route->uri){
                $space = "\\App\\Controller\\" ;
                $controller = $space . $route->controller;
                $controller_name = new $controller();
                $controller_name->$action();
            }
        }
    }
}