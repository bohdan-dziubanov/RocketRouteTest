<?php

spl_autoload_register(function ($className)
{
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    include $className . '.php';
});

use routing\Router;

class Application
{
    public function createInstance()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        
        $router = new Router($uri, $method);

        $router->execute();
    }
}
