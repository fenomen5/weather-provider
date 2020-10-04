<?php


namespace WeatherWriter\Models;

/**
 * Модель для хранения данных прогноза о температуре
 * Class ForecastTemperature
 * @package WeatherWriter\Models
 */
class ForecastTemperature
{
    private $temp;
    private $feels_like;
    private $temp_min;
    private $temp_max;

    public function __construct($temp, $feels_like, $temp_min, $temp_max)
    {
        $this->temp = $temp;
        $this->feels_like = $feels_like;
        $this->temp_min = $temp_min;
        $this->temp_max = $temp_max;
    }

    /**
     * @return mixed
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @return mixed
     */
    public function getFeelsLike()
    {
        return $this->feels_like;
    }

    /**
     * @return mixed
     */
    public function getTempMin()
    {
        return $this->temp_min;
    }

    /**
     * @return mixed
     */
    public function getTempMax()
    {
        return $this->temp_max;
    }

}