<?php

namespace routing;

use controllers\ErrorController;

class Router extends AbstractRouter
{
    protected function initializeMethods()
    {
        $this->addRoute('GET', '', 'ApiController@index');
        $this->addRoute('GET', '/search', 'ApiController@search');
        $this->addRoute('GET', '/error', 'ErrorController@index');
    }

    public function execute()
    {
        $this->initializeMethods();

        $hashKey = md5($this->uri . $this->method);
        $methodData = isset($this->routs[$hashKey]) ? $this->routs[$hashKey] : null;

        $methodData = !empty($methodData) ? $methodData : 'ErrorController@index';

        $handler = explode('@', $methodData);

        try
        {
            $className = 'controllers\\' . $handler[0];
            $controller = new $className;
            $method = $handler[1];
            $controller->$method($this->request);
        }
        catch (\Exception $e)
        {
            $controller = new ErrorController();
            $controller->index($request, $e->getMessage());
        }
    }
}

