<?php


namespace WeatherWriter\Models;

/**
 * Коллекция прогнозов для различных локаций
 * Class LocationForecasts
 * @package WeatherWriter\Models
 */
class LocationForecasts implements ILocationForecastCollection
{
    private $locations;

    public function __construct()
    {
        $this->locations = [];
    }

    /**
     * Получить проноз из коллекции
     * @param $index
     * @return ILocationForecast
     */
    public function get($index): ILocationForecast
    {
        return $this->locations[$index];
    }

    /**
     * Добавить проноз в коллекцию
     * @param ILocationForecast $forecast
     */
    public function add(ILocationForecast $forecast)
    {
        $this->locations[] = $forecast;
    }

    /**
     * Удалить прогноз из коллекции
     * @param $index
     * @return bool
     */
    public function remove($index): bool
    {
        $this->locations[$index];
    }

    /**
     * Получить количество прогнозов в коллекции
     * @return int
     */
    public function count(): int
    {
        return count($this->locations);
    }


}