<?php

namespace routing;

class Router extends AbstractRouter
{
    protected function initializeMethods()
    {
        $this->addRoute('GET', '', 'ApiController@index');
        $this->addRoute('GET', '/search', 'ApiController@search');
        $this->addRoute('GET', '/notFound', 'ErrorController@notFound');
    }

    public function execute()
    {
        $this->initializeMethods();

        $hashKey = md5($this->uri . $this->method);
        $methodData = isset($this->routs[$hashKey]) ? $this->routs[$hashKey] : null;

        $methodData = !empty($methodData) ? $methodData : 'ErrorController@notFound';

        $handler = explode('@', $methodData);

        $className = 'controllers\\' . $handler[0];
        $controller = new $className;
	$method = $handler[1];
        $controller->$method($this->request);
    }
}

