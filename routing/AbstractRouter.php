<?php

namespace routing;

abstract class AbstractRouter
{
    protected $uri;
    protected $method;
    protected $request;

    protected $routs = [];

    public function __construct($uri, $method, $request)
    {
        $this->uri = preg_replace('{/$}', '', $uri);
        $this->method = $method;
        $this->request = $request;
    }

    abstract protected function initializeMethods();

    public function addRoute($method, $uri, $handler)
    {
        $hashKey = md5($uri . $method);
        $this->routs[$hashKey] = $handler;
    }
}

