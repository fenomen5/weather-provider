<?php

namespace WeatherWriter\Models;

interface ILocationForecast
{
    public function getLocationId();
    public function getDate();

    public function setCityData(ForecastCity $city);
    public function setTemperatureData(ForecastTemperature $temperature);
    public function setWindData(ForecastWind $windData);

    public function getCityData() : ForecastCity;
    public function getTemperatureData() : ForecastTemperature;
    public function getWindData() : ForecastWind;
}