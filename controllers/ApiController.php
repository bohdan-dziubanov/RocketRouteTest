<?php

namespace controllers;

class ApiController extends BasicController
{
    public function index($request)
    {
        $this->args = [
            'title' => 'RocketRoute welcome page',
            'button' => 'submit',
            'placeholder' => 'ICAO',
            'text' => 'ICAO code'
        ];

        $this->includeTemplate('api/index.php');
    }

    public function search($request)
    {
        $this->args = [
            'title' => 'RocketRoute search',
            'button' => 'submit',
            'placeholder' => 'ICAO',
            'text' => 'ICAO code',
            'value' => isset($request['code']) ? $request['code'] : ''
        ];

        $this->includeTemplate('api/search.php');
    }
}

