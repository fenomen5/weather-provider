<?php


namespace WeatherWriter\Providers\Config;


interface IConfig
{
    public function get($param_name);
}