<?php

namespace WeatherWriter\Models;

/**
 * Модель для хранения данных прогноза для локации
 * Class LocationForecast
 * @package WeatherWriter\Models
 */
class LocationForecast implements ILocationForecast
{
    /** @var $cityData ForecastCity */
    private $cityData;
    private $tempData;
    private $windData;
    private $date;

    public function __construct()
    {
    }

    public function setCityData(ForecastCity $cityData)
    {
        $this->cityData = $cityData;
    }

    public function setTemperatureData(ForecastTemperature $tempData)
    {
        $this->tempData = $tempData;
    }

    public function setWindData(ForecastWind $windData)
    {
        $this->windData = $windData;
    }

    public function getLocationId()
    {
        return $this->cityData->getId();
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return ForecastCity
     */
    public function getCityData(): ForecastCity
    {
        return $this->cityData;
    }

    /**
     * @return mixed
     */
    public function getTemperatureData() : ForecastTemperature
    {
        return $this->tempData;
    }

    /**
     * @return mixed
     */
    public function getWindData() : ForecastWind
    {
        return $this->windData;
    }


}