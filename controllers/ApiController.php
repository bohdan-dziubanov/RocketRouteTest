<?php

namespace controllers;

class ApiController extends BasicController {

    public function index($request) {
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
        $password = 'F8kPPaRbQZqjWTzzrbaR';
        $md5Key = '4GnRqmDpNH3PHuPLmZLS';
        $usr = 'bohdan.dziubanov@gmail.com';
        $category = 'Free';
        $deviceId = 'bohdan.dziubanov@gmail.com';
        $curlUrl = 'https://flydev.rocketroute.com/remote/auth';
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $curlUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "req=%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%20%3F%3E%20%3CAUTH%3E%20%3CUSR%3E{$usr}%3C%2FUSR%3E%20%3CPASSWD%3E{$password}%3C%2FPASSWD%3E%20%3CDEVICEID%3E{$deviceId}%3C%2FDEVICEID%3E%20%3CPCATEGORY%3E{$category}%3C%2FPCATEGORY%3E%20%3CAPPMD5%3E{$md5Key}%3C%2FAPPMD5%3E%20%3C%2FAUTH%3E",
            CURLOPT_HTTPHEADER => [
                'content-type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err)
        {
            echo "cURL Error #:" . $err;
        }
        else
        {
            $resultUsXml = new \SimpleXMLElement($response);
            $resultAsArray = json_decode(json_encode($resultUsXml), TRUE);

            $key = $resultAsArray['KEY'];
        }

        $request = '<?xml version="1.0" encoding="UTF-8" ?>'
            . '<REQNOTAM>'
            . "<USR>{$usr}</USR>"
            . "<PASSWD>{$key}</PASSWD>"
            . "<ICAO>EGLL</ICAO>"
            . '</REQNOTAM>';

        $client = new \SoapClient('https://apidev.rocketroute.com/notam/v1/service.wsdl');
        $response = $client->getNotam($request);
var_dump($response);
exit;

//        $this->args = [
//            'title' => 'RocketRoute search',
//            'button' => 'submit',
//            'placeholder' => 'ICAO',
//            'text' => 'ICAO code',
//            'value' => isset($request['code']) ? $request['code'] : ''
//        ];
//
//        $this->includeTemplate('api/search.php');
    }

}
