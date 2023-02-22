<?php 

namespace Http;

use Http\Route;

/**
 * Class Router to generate route
 */
class Router{    
    /**
     * Stock the value of the controller 
     *
     * @var mixed
     */
    public $controller_name;    
    /**
     * Which method to invoke
     *
     * @var mixed
     */
    public $action;    
    /**
     * Stock all of the routes 
     *
     * @var array
     */
    public $routes = [];    
    /**
     * Get a route with a name
     *
     * @var array
     */
    public $route_name = [];
    
    /**
     * Determine if router match with uri
     *
     * @var bool
     */
    public $success = false;

    
    /**
     * Keep the value of slug 
     *
     * @var array
     */
    public $matches = [];
    
    /**
     * Set route with  method GET
     *
     * @param  mixed $uri
     * @param  mixed $controller_name
     * @param  mixed $action
     * @return Router
     */
    public function get($uri,$controller_name,$action) :Router
    {
       $routes = new Route($uri,$controller_name,$action);
            $this->routes[] = $routes; 
            return $this;
    }
    
    /**
     * Set route with method POST
     *
     * @param  mixed $uri
     * @param  mixed $controller_name
     * @param  mixed $action
     * @return Router
     */
    public function post($uri,$controller_name,$action) :Router
    {
       $this->route = new Route($uri,$controller_name,$action);
            $this->routes[] = $this->route;
            return $this;
    }
    
    /**
     * Add the uri to the array route
     *
     * @param  mixed $route
     * @return Router
     */

    public function name(string $name): Router
    {
        $this->route_name[] = $name;

        return $this;
    }
    
    /**
     * If route matche to URI,load the views
     *
     * @return void
     */
    public function run()
    {
        foreach($this->routes as $route){
            $action = $route->action;
            $path = preg_replace('#:([\w]+)#', '([^/]+)', $route->uri);
            $regex = "{^$path$}";
            if($_SERVER['REQUEST_URI'] == $route->uri || preg_match($regex,$_SERVER['REQUEST_URI'],$matches)){
                $this->matches[] = array_pop($matches);
                $space = "\\App\\Controller\\" ;
                $controller = $space . $route->controller;
                $controller_name = new $controller();
                $controller_name->$action($this->matches);
                return true;
            }
        }
        return false;
    }
}
