<?php

namespace soap;

class NOTAMSoap extends BaseSoap
{
    private $ICAOCode;

    public function __construct($ICAOCode)
    {
        $this->ICAOCode = $ICAOCode;
    }

    public function getResponse()
    {
        $notams = [];

        $requestSoap = '<?xml version="1.0" encoding="UTF-8" ?>'
            . '<REQNOTAM>'
            . "<USR>{$this->usr}</USR>"
            . "<PASSWD>3b239f8dd0a3ed058dde1792254144c8</PASSWD>"
            . "<ICAO>{$this->ICAOCode}</ICAO>"
            . '</REQNOTAM>';

        $client = new \SoapClient('https://apidev.rocketroute.com/notam/v1/service.wsdl');

        $response = $client->getNotam($requestSoap);
        $responseUsXml = new \SimpleXMLElement($response);
        $responseArray = json_decode(json_encode($responseUsXml), TRUE);

        if (isset($responseArray['NOTAMSET']['NOTAM'][0]))
        {
            foreach ($responseArray['NOTAMSET']['NOTAM'] as $notam)
            {
                $coords = $this->__getCoord($notam['ItemQ']);
                $notams[] = ['coord' => $coords , 'hint' => isset($notam['ItemE']) ? $notam['ItemE'] : ''];
            }
        }
        else if (isset ($responseArray['NOTAMSET']['NOTAM']['ItemQ']))
        {
            $coords = $this->__getCoord($responseArray['NOTAMSET']['NOTAM']['ItemQ']);
            $notams[] = ['coord' => $coords , 'hint' => isset($responseArray['NOTAMSET']['NOTAM']['ItemE']) ?
                $responseArray['NOTAMSET']['NOTAM']['ItemE'] : ''];
        }
        else
        {
            throw new \Exception('Any NOTAM has not been found', 404);
        }

        return $notams;
    }

    private function __getCoord($dms)
    {
        preg_match('/^.*\/(.*)$/', $dms, $params);
        $coords = $params[1];

        $lat = $this->__DMStoDEC((int)substr($coords, 0, 2), (int)substr($coords, 2, 2));
        $lat = substr($coords, 4, 1) === 'N' ? $lat : -$lat;
        $lng = $this->__DMStoDEC((int)substr($coords, 5, 3), (int)substr($coords, 8, 2));
        $lng = substr($coords, 10, 1) === 'E' ? $lng : -$lng;

        return ['lat' => $lat, 'lng' => $lng];
    }

    private function __DMStoDEC($deg, $min)
    {
        return $deg + $min * 60 / 3600;
    }
}

