<?php

use routing\Router;

class Application
{
    public function createInstance()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $request = $_REQUEST;
        
        $router = new Router($uri, $method, $request);

        $router->execute();
    }
}
