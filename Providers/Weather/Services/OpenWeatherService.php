<?php

namespace WeatherWriter\Providers\Weather\Services;

use WeatherWriter\HttpClients\IHttpClient;
use WeatherWriter\Providers\Config\IConfig;

class OpenWeatherService implements IWeatherService
{
    private $httpClient;
    private $request;

    public function __construct(IConfig $config, IHttpClient $httpClient)
    {
        $this->request = $config->get('request');
        $this->httpClient = $httpClient;
    }

    /**
     * Получение данных от сервиса
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function fetchData()
    {
        if (empty($this->request) || array_intersect(['method','uri'], $this->request) < 2) {
            throw new \InvalidArgumentException('Не заданы параметры для выполнения запроса');
        }

        $response = $this->httpClient->fetchData($this->request['method'], $this->request['uri']);

        return $response->getBody()->getContents();
    }
}