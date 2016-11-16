<?php

namespace controllers;

use soap\NOTAMSoap;

class ApiController extends BasicController {

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
        if(empty($request['code']))
        {
            throw new \Exception('ICAO code is required', 400);
        }

        $category = 'RocketRoute';
        $deviceId = 'e138231a68ad82f054e3d756c6634ba1';

        $soap = new NOTAMSoap($request['code']);
        $soap->auth($category, $deviceId);
        $notams = $soap->getResponse();

        $this->args = [
           'title' => 'RocketRoute search',
           'button' => 'submit',
           'placeholder' => 'ICAO',
           'text' => 'ICAO code',
           'code' => isset($request['code']) ? $request['code'] : '',
           'notams' => json_encode($notams)
        ];

        $this->includeTemplate('api/search.php');
    }
}
