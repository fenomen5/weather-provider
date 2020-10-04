<?php


namespace WeatherWriter\Models;

/**
 * Модель для хранения данных прогноза о городе
 * Class ForecastCity
 * @package WeatherWriter\Models
 */
class ForecastCity
{
    private $id;
    private $name;
    private $timezone;
    private $country;
    private $lon;
    private $lat;

    public function __construct($id, $name, $timezone, $country, $lon, $lat)
    {
        $this->id = $id;
        $this->name = $name;
        $this->timezone = $timezone;
        $this->country = $country;
        $this->lon = $lon;
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }
}