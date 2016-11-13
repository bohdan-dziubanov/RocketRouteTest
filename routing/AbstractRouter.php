<?php

namespace routing;

abstract class AbstractRouter
{
    protected $uri;
    protected $method;
    protected $request;

    protected $get = [];
    protected $post = [];

    public function __construct($uri, $method, $request)
    {
        $this->uri = preg_replace('{/$}', '', $uri);
        $this->method = $method;
        $this->request = $request;
    }

    abstract protected function initializeMethods();

    public function get($uri, $handler)
    {
        $hashKey = md5($uri . 'get');
        $this->get[$hashKey] = ['uri' => $uri, 'handler' => $handler];
    }

    public function post($uri, $controller)
    {
        $hashKey = md5($uri . 'post');
        $this->post[$hashKey] = ['uri' => $uri, 'handler' => $handler];
    }
}

