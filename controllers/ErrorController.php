<?php

namespace controllers;

class ErrorController extends BasicController
{
    public function index($request, $message = 'Page not found')
    {
        $this->args = [
            'message' => $message,
            'title' => 'RocketRoute welcome page',
            'button' => 'submit',
            'placeholder' => 'ICAO',
            'text' => 'ICAO code'
        ];

        $this->includeTemplate('error/index.php');
    }
}

