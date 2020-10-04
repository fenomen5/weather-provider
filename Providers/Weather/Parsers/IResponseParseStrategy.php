<?php

namespace WeatherWriter\Providers\Weather\Parsers;

use WeatherWriter\Models\ILocationForecastCollection;

interface IResponseParseStrategy
{
    public function parseResponse($response): ILocationForecastCollection;
}