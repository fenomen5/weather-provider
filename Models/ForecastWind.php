<?php


namespace WeatherWriter\Models;

/**
 * Модель для хранения данных прогноза о ветре
 * Class ForecastWind
 * @package WeatherWriter\Models
 */
class ForecastWind
{
    private $speed;
    private $direction;

    public function __construct($speed, $direction)
    {
        $this->speed = $speed;
        $this->direction = $direction;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

}