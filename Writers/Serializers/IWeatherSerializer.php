<?php


namespace WeatherWriter\Writers\Serializers;


use WeatherWriter\Models\ILocationForecastCollection;

interface IWeatherSerializer
{
    public function serialize(ILocationForecastCollection $forecasts);
}