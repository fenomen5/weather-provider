<?php

namespace WeatherWriter\Providers\Weather;

use WeatherWriter\HttpClients\GuzzleClient;
use WeatherWriter\Providers\Config\IConfig;
use WeatherWriter\Providers\Weather\Parsers\OpenWeatherParseStrategy;
use WeatherWriter\Providers\Weather\Services\OpenWeatherService;

/**
 * Фабрика создания провайдеров погоды
 * Class WeatherProviderFactory
 * @package Weather\Providers
 */
class WeatherProviderFactory
{
    /**
     * Получение провайдера прогноза погоды
     * @param array $config
     * @return IWeatherProvider
     */
    public function getProvider($class, IConfig $config) : IWeatherProvider
    {
        switch ($class) {
            case 'OpenWeatherProvider':
            default:
                $httpClient = new GuzzleClient($config->get('http_client_settings'));
                $weatherService = new OpenWeatherService($config, $httpClient);
                $responseParser = new OpenWeatherParseStrategy();

                return new WeatherProvider($weatherService, $responseParser);
        }
    }
}