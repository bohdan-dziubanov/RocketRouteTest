<?php

namespace controllers;

class ApiController extends BasicController
{
    public function index($request)
    {
        $this->args = [
            'button' => 'submit',
            'placeholder' => 'ICAO',
            'text' => 'ICAO code'
        ];

        $this->includeTemplate('api/index.php');
    }

    public function search($request)
    {
        echo 'search';
    }
}

