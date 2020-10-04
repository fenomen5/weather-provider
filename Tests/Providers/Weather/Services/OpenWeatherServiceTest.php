<?php

namespace WeatherWriter\Tests\Providers\Weather\Services;

use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use WeatherWriter\HttpClients\GuzzleClient;
use WeatherWriter\Providers\Config\Settings;
use WeatherWriter\Providers\Weather\Services\OpenWeatherService;


class OpenWeatherServiceTest extends TestCase
{
    private $httpClient;
    private $request;
    private $service;

    public function setUp(): void
    {
        require 'loader.php';
    }

    /**
     * Проверка исключения если не указана строка запроса
     */
    public function testFetchDataInvalidParametersException()
    {
        $httpClient = $this->createMock(GuzzleClient::class);
        $config = $this->createMock(Settings::class);
        $config->method('get')->willReturn('');
        $weatherService = new OpenWeatherService($config, $httpClient);

        $this->expectException(\InvalidArgumentException::class);
        $weatherService->fetchData();
    }

}
