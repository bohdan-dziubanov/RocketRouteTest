<?php

namespace routing;

class Router extends AbstractRouter
{
    protected function initializeMethods()
    {
        $this->get('', 'ApiController@index');
        $this->get('/search', 'ApiController@search');
        $this->get('/notFound', 'ErrorController@notFound');
    }

    public function execute()
    {
        $this->initializeMethods();

        if ($this->method === 'GET')
        {
            $hashKey = md5($this->uri . 'get');
            $methodData = isset($this->get[$hashKey]) ? $this->get[$hashKey] : null;
        }
        else if ($this->method === 'POST')
        {
            $hashKey = md5($this->uri . 'post');
            $methodData = isset($this->post[$hashKey]) ? $this->post[$hashKey] : null;
        }

        $methodData = !empty($methodData) ? $methodData : ['uri' => '/error',
            'handler' => 'ErrorController@notFound'];

        $handler = explode('@', $methodData['handler']);

        $className = 'controllers\\' . $handler[0];
        $controller = new $className;
        $controller->$handler[1]($this->request);
    }
}

