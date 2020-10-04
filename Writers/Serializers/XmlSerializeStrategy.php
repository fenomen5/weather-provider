<?php

namespace WeatherWriter\Writers\Serializers;

use WeatherWriter\Models\ILocationForecastCollection;

/**
 * Стратегия для сериализации данных в в XML формат
 * Class XmlSerializeStrategy
 * @package WeatherWriter\Writers\Serializers
 */
class XmlSerializeStrategy implements IWeatherSerializer
{
    /**
     * Сериализация данных
     * @param ILocationForecastCollection $forecasts
     * @return false|string
     */
    public function serialize(ILocationForecastCollection $forecasts)
    {
        $xml = new \SimpleXMLElement('<root/>');

        for ($i = 0 ; $i < $forecasts->count(); $i++) {

            $forecastData = $forecasts->get($i);
            $child = $xml->addChild('location');
            $child->addChild('date', $forecastData->getDate());
            $child->addChild('wind_speed', $forecastData->getWindData()->getSpeed());
            $child->addChild('temperature', $forecastData->getTemperatureData()->getTemp());
            $child->addChild('wind_direction', $forecastData->getWindData()->getDirection());
            $child->addChild('temperature_min', $forecastData->getTemperatureData()->getTempMin());
            $child->addChild('temperature_max', $forecastData->getTemperatureData()->getTempMax());
            $child->addChild('temperature_feels_like', $forecastData->getTemperatureData()->getFeelsLike());
            $child->addChild('city_name', $forecastData->getCityData()->getName());
            $child->addChild('lon', $forecastData->getCityData()->getLon());
            $child->addChild('lat', $forecastData->getCityData()->getLat());
        }


        return $this->toFormattedXml($xml->asXML());
    }

    /**
     * Форматирование выходного XML для удобства чтения
     * @param $xml
     * @return false|string
     */
    private function toFormattedXml($xml)
    {
        $domxml = new \DOMDocument('1.0');
        $domxml->preserveWhiteSpace = false;
        $domxml->formatOutput = true;
        $domxml->loadXML($xml);
        return $domxml->saveXML();
    }
}