<?php

namespace soap;

class NOTAMSoap extends BaseSoap
{
    use \controllers\GeoTrait;
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
            . "<PASSWD>{$this->token}</PASSWD>"
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
}

