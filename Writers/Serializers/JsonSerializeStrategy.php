<?php

namespace WeatherWriter\Writers\Serializers;

use WeatherWriter\Models\ILocationForecastCollection;

/**
 * Стратегия для сериализации данных в в JSON формат
 * Class JsonSerializeStrategy
 * @package WeatherWriter\Writers\Serializers
 */
class JsonSerializeStrategy implements IWeatherSerializer
{
    /**
     * Выполнение сериализации данных
     * @param ILocationForecastCollection $forecasts
     * @return false|string
     */
    public function serialize(ILocationForecastCollection $forecasts)
    {
        $data = [];
        for ($i = 0 ; $i < $forecasts->count(); $i++) {

            $forecastData = $forecasts->get($i);
            $data[] = [
                'date' => $forecastData->getDate(),
                'temperature' => $forecastData->getTemperatureData()->getTemp(),
                'wind_direction' => $forecastData->getWindData()->getDirection(),
                'wind_speed' => $forecastData->getWindData()->getSpeed(),
                'temperature_min' => $forecastData->getTemperatureData()->getTempMin(),
                'temperature_max' => $forecastData->getTemperatureData()->getTempMax(),
                'temperature_feels_like' => $forecastData->getTemperatureData()->getFeelsLike(),
                'city_name' => $forecastData->getCityData()->getName(),
                'lon' => $forecastData->getCityData()->getLon(),
                'lat' => $forecastData->getCityData()->getLat()
            ];
        }

        return json_encode($data);
    }
}