<?php


namespace WeatherWriter\Models;


interface ILocationForecastCollection
{
    public function get($index) : ILocationForecast;
    public function add(ILocationForecast $forecast);
    public function remove($index): bool;
    public function count() : int;
}