<?php

namespace WeatherWriter\HttpClients;

interface IHttpClient
{
    /**
     * Выполнить запрос на получение данных
     */
    public function fetchData($method, $url);
}