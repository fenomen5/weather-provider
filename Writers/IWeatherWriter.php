<?php

namespace WeatherWriter\Writers;

use WeatherWriter\Models\ILocationForecastCollection;

interface IWeatherWriter
{
    public function write(ILocationForecastCollection $data);
}