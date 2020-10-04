<?php


namespace WeatherWriter\Writers;


use WeatherWriter\Models\ILocationForecastCollection;
use WeatherWriter\Writers\IWeatherWriter;
use WeatherWriter\Writers\Serializers\IWeatherSerializer;

/**
 * Класс для записи прогноза погоды в файл
 * Class WeatherFileWriter
 * @package WeatherWriter\Writers
 */
class WeatherFileWriter implements IWeatherWriter
{
    private $serializer;
    private $fileName;

    public function __construct(IWeatherSerializer $serializer, $fileName)
    {
        $this->serializer = $serializer;
        $this->fileName = $fileName;
    }

    /**
     * Запись данных о прогнозе погоды в файл
     * @param ILocationForecastCollection $data
     * @throws \Exception
     */
    public function write(ILocationForecastCollection $data)
    {
        $serializedData = $this->serializer->serialize($data);

        $time = strtotime('now');
        $pathInfo = pathinfo($this->fileName);
        $pathInfo['dirname'] = strlen($pathInfo['dirname']) > 1 ? $pathInfo['dirname'] : '';

        $path = $pathInfo['dirname'] . $pathInfo['filename'] . $time . '.' . $pathInfo['extension'];
        $file = fopen($path, "w");
        if (!$file) {
            throw new \Exception("Невозможно открыть файл для записи");
        }

        fwrite($file, $serializedData);
        fclose($file);
    }
}