<?php

namespace soap;

abstract class BaseSoap
{
    protected $usr = 'bohdan.dziubanov@gmail.com';
    protected $pass = 'F8kPPaRbQZqjWTzzrbaR';
    protected $md5key = '4GnRqmDpNH3PHuPLmZLS';
    protected $authUrl = 'https://flydev.rocketroute.com/remote/auth';
    protected $token;

    public function auth($category, $deviceId, $curlUrl)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $curlUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "req=%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%20%3F%3E%20%3CAUTH%3E%20%3CUSR%3E{$this->usr}%3C%2FUSR%3E%20%3CPASSWD%3E{$this->password}%3C%2FPASSWD%3E%20%3CDEVICEID%3E{$deviceId}%3C%2FDEVICEID%3E%20%3CPCATEGORY%3E{$category}%3C%2FPCATEGORY%3E%20%3CAPPMD5%3E{$this->md5Key}%3C%2FAPPMD5%3E%20%3C%2FAUTH%3E",
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

            if (empty($resultAsArray['KEY']))
            {
                throw new \Exception('Unauthorized', 401);
            }

            $this->key = $resultAsArray['KEY'];
        }
    }
}