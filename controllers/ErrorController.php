<?php

namespace controllers;

class ErrorController extends BasicController
{
    public function notFound($request)
    {
        echo 'Page not found';
    }
}

