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
            CURLOPT_POSTFIELDS => "req=%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%20%3F%3E%20%3CAUTH%3E%20%3CUSR%3Ebohdan.dziubanov%40gmail.com%3C%2FUSR%3E%20%3CPASSWD%3EF8kPPaRbQZqjWTzzrbaR%3C%2FPASSWD%3E%20%3CDEVICEID%3E1299f2aa8935b9ffabcd4a2cbcd16b8d45691629%3C%2FDEVICEID%3E%20%3CPCATEGORY%3ERocketRoute%3C%2FPCATEGORY%3E%20%3CAPPMD5%3E4GnRqmDpNH3PHuPLmZLS%3C%2FAPPMD5%3E%20%3C%2FAUTH%3E",
            CURLOPT_HTTPHEADER => [
                'cache-control: no-cache',
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
var_dump($resultAsArray);exit;//681cb0493afd63628a15b88340222f2e
            if (empty($resultAsArray['KEY']))
            {
                throw new \Exception('Unauthorized', 401);
            }

            $this->token = $resultAsArray['KEY'];
        }
    }
}
