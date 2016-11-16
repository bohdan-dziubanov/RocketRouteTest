<?php

namespace soap;

abstract class BaseSoap
{
    protected $usr = 'bohdan.dziubanov@gmail.com';
    protected $pass = 'F8kPPaRbQZqjWTzzrbaR';
    protected $md5key = '4GnRqmDpNH3PHuPLmZLS';
    protected $authUrl = 'https://flydev.rocketroute.com/remote/auth';
    protected $token;

    public function auth($category, $deviceId)
    {
        $curl = curl_init();
        $req = 'req:<?xml version="1.0" encoding="UTF-8" ?>'
            . '<AUTH>'
            . "<USR>{$this->usr}</USR>"
            . "<PASSWD>{$this->pass}</PASSWD>"
            . "<DEVICEID>{$deviceId}</DEVICEID>"
            . "<PCATEGORY>{$category}</PCATEGORY>"
            . "<APPMD5>$this->md5key</APPMD5>"
            . '</AUTH>';

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->authUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => htmlspecialchars($req),
            CURLOPT_HTTPHEADER => [
                'content-type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err)
        {
            throw new \Exception($err, 401);
        }
        else
        {
            $resultUsXml = new \SimpleXMLElement($response);
            $resultAsArray = json_decode(json_encode($resultUsXml), TRUE);
var_dump(htmlspecialchars($req));exit;
            if (empty($resultAsArray['KEY']))
            {
                throw new \Exception('Unauthorized', 401);
            }

            $this->token = $resultAsArray['KEY'];
        }
    }
}
