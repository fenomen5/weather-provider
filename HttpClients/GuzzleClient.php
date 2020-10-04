<?php

namespace WeatherWriter\HttpClients;

use GuzzleHttp;

/**
 * Класс для выполнения запросов на получение данных по http протоколу
 * Class GuzzleClient
 * @package WeatherWriter\HttpClients
 */
class GuzzleClient extends GuzzleHttp\Client implements IHttpClient
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * Выполнить запрос на получение данных
     * @param $method
     * @param $url
     * @return \Psr\Http\Message\ResponseInterface
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    public function fetchData($method, $url)
    {
       return $this->request($method, $url);
    }
}