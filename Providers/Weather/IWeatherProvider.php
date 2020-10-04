<?php


namespace WeatherWriter\Providers\Weather;

use WeatherWriter\Models\ILocationForecastCollection;

interface IWeatherProvider
{
    public function getWeatherData() : ILocationForecastCollection;
}