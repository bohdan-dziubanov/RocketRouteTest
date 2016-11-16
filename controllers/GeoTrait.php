<?php

namespace controllers;

trait GeoTrait
{
    public function __getCoord($dms)
    {
        preg_match('/^.*\/(.*)$/', $dms, $params);
        $coords = $params[1];

        $lat = $this->__DMStoDEC((int)substr($coords, 0, 2), (int)substr($coords, 2, 2));
        $lat = substr($coords, 4, 1) === 'N' ? $lat : -$lat;
        $lng = $this->__DMStoDEC((int)substr($coords, 5, 3), (int)substr($coords, 8, 2));
        $lng = substr($coords, 10, 1) === 'E' ? $lng : -$lng;

        return ['lat' => $lat, 'lng' => $lng];
    }

    public function __DMStoDEC($deg, $min)
    {
        return $deg + $min * 60 / 3600;
    }
}