<?php

namespace controllers;

class ErrorController extends BasicController
{
    public function notFound($request)
    {
        $this->args = [
            'message' => 'Page not found'
        ];

        $this->includeTemplate('error/index.php');
    }
}

