<?php

namespace WeatherWriter\Writers;

use WeatherWriter\Writers\IWeatherWriter;
use WeatherWriter\Writers\Serializers\JsonSerializeStrategy;
use WeatherWriter\Writers\Serializers\XmlSerializeStrategy;

/**
 * Фабрика создания сериализаторов
 * Class SerializersFactory
 * @package Weather\Providers
 */
class FileWritersFactory
{
    /**
     * Создание объекта для сохранения прогноза погоды
     * @param $type
     * @param $fileName
     * @return \WeatherWriter\Writers\IWeatherWriter
     */
    public function getWriter($type, $fileName) : IWeatherWriter
    {
        switch ($type) {
            case 'json':
                $fileName .= '.json';
                print_r($fileName);
                $serializer = new JsonSerializeStrategy();
                $writer = new WeatherFileWriter($serializer, $fileName);
                break;
            case 'xml':
            default:
            $fileName .= '.xml';
            $serializer = new XmlSerializeStrategy();
            $writer = new WeatherFileWriter($serializer, $fileName);
        }

        return $writer;
    }
}