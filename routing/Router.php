<?php

namespace routing;

class Router extends AbstractRouter
{
    protected function addMethods()
    {
        $this->get('/', 'ApiController@index');
        $this->get('/search', 'ApiController@search');
    }

    public function execute()
    {
        $this->addMethods();

        if ($this->method === 'GET')
        {
            $hashKey = md5($this->uri . 'get');

            if (!isset($this->get[$hashKey]))
            {
                echo 'Page does not exist';
                //throw new Exception('Page does not exist', 404);
            }
        }
        else if ($this->method === 'POST')
        {
            $hashKey = md5($this->uri . 'post');

            if (!isset($this->get[$hashKey]))
            {
                echo 'Page does not exist';
                //throw new Exception('Page does not exist', 404);
            }
        }

        
    }
}

