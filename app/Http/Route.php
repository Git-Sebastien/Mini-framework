<?php 


  namespace Http;


  class Route{
    public $uri;
    public $controller;
    public $action;

    public function __construct($uri,$controller,$action)
    {
        $this->uri = $uri;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function match()
    {
        dd($this->uri);
    }
  }


