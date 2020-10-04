<?php


namespace WeatherWriter\Providers\Weather\Parsers;

use WeatherWriter\Models\ForecastCity;
use WeatherWriter\Models\ForecastTemperature;
use WeatherWriter\Models\ForecastWind;
use WeatherWriter\Models\ILocationForecastCollection;
use WeatherWriter\Models\LocationForecast;
use WeatherWriter\Models\LocationForecasts;

/**
 * Стратегия для получения прогноза погоды из сервиса OpenWeather
 * Class OpenWeatherParseStrategy
 * @package WeatherWriter\Providers\Weather\Parsers
 */
class OpenWeatherParseStrategy implements IResponseParseStrategy
{
    /**
     * Парсинг ответа от сервиса
     * @param $response
     * @return ILocationForecastCollection
     * @throws \Exception
     */
    public function parseResponse($response): ILocationForecastCollection
    {
        $data = json_decode($response, true);
        $forecastItems = $this->getForecastsItems($data);

        $locationForecasts = new LocationForecasts();

        foreach ($forecastItems as $forecastItem) {

            $forecastLocation = new LocationForecast();
            $forecastLocation->setDate($forecastItem['dt']);
            $city = $this->createForecastCity($forecastItem);
            $forecastLocation->setCityData($city);
            $temp = $this->createForecastTemp($forecastItem);
            $forecastLocation->setTemperatureData($temp);
            $wind = $this->createForecastWind($forecastItem);
            $forecastLocation->setWindData($wind);

            $locationForecasts->add($forecastLocation);
        }

        return $locationForecasts;
    }

    /**
     * Получение списка прогнозов погоды
     * @param $forecastData
     * @return mixed
     * @throws \Exception
     */
    private function getForecastsItems($forecastData)
    {
        $param = 'list';
        if (!isset($forecastData[$param])) {
            throw new \Exception('Не найден ожидаемый параметр' . $param);
        }

        return $forecastData[$param];
    }

    /**
     * Создание элемента прогноза - город
     * @param $forecastItem
     * @return ForecastCity
     */
    private function createForecastCity($forecastItem)
    {
        $id = $forecastItem['id'] ?? null;
        $name = $forecastItem['name'] ?? '';
        $timezone = $forecastItem['sys']['timezone'] ?? '';
        $country = $forecastItem['sys']['country'] ?? '';
        $lon = $forecastItem['coord']['lon'] ?? null;
        $lat = $forecastItem['coord']['lat'] ?? null;

        return new ForecastCity($id, $name, $timezone, $country, $lon, $lat);
    }

    /**
     * Создание элемента прогноза - температура
     * @param $forecastItem
     * @return ForecastTemperature
     */
    private function createForecastTemp($forecastItem)
    {
        $temp = $forecastItem['main']['temp'] ?? null;
        $feels_like = $forecastItem['main']['feels_like'] ?? null;
        $temp_min = $forecastItem['main']['temp_min'] ?? null;
        $temp_max = $forecastItem['main']['temp_max'] ?? null;

        return new ForecastTemperature($temp, $feels_like, $temp_min, $temp_max);
    }

    /**
     * Создание элемента прогноза - ветер
     * @param $forecastItem
     * @return ForecastWind
     */
    private function createForecastWind($forecastItem)
    {
        $speed = $forecastItem['wind']['speed'];
        $deg = $forecastItem['wind']['deg'];
        $forecastWind = new ForecastWind($speed, $deg);

        return $forecastWind;
    }
}