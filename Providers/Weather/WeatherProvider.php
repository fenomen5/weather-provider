<?php


namespace WeatherWriter\Providers\Weather;


use WeatherWriter\Models\ILocationForecastCollection;
use WeatherWriter\Providers\Weather\Parsers\IResponseParseStrategy;
use WeatherWriter\Providers\Weather\Services\IWeatherService;

/**
 * Класс для работы с провайдерами прогноза погоды
 * Class WeatherProvider
 * @package WeatherWriter\Providers\Weather
 */
class WeatherProvider implements IWeatherProvider
{
    private $weatherService;
    private $parser;

    public function __construct(IWeatherService $weatherService, IResponseParseStrategy $responseParser)
    {
        $this->weatherService = $weatherService;
        $this->parser = $responseParser;
    }

    /**
     * Получить данные
     */
    public function getWeatherData() : ILocationForecastCollection
    {
        try {
            $data = $this->weatherService->fetchData();
        } catch (\Throwable $t) {
            //todo записать в лог оригинальное исключение
            throw new \Exception("Ошибка получения данных о погоде");
        }

        return $this->parser->parseResponse($data);
    }
}