<?php

require 'vendor/autoload.php';
require 'loader.php';

use WeatherWriter\Providers;
use WeatherWriter\Providers\Config;

$fileFormatOption = "format::";
$options = getopt('', [$fileFormatOption]);

$configPath = __DIR__ . DIRECTORY_SEPARATOR . 'Config/config.php';

$appConfig = new Config\Settings($configPath);

$outputFormat = setFormat($appConfig->get('allowed_formats'), $options);

if (empty($appConfig->get('active_weather_provider'))) {
    throw new Exception('Не указан активный провайдер');
}

$providerClass = $appConfig->get('active_weather_provider.class');
$providerConfigFile = $appConfig->get('active_weather_provider.config');

$providerConfig = new Config\Settings($providerConfigFile);

$weatherFactory = new Providers\Weather\WeatherProviderFactory();
$weatherProvider = $weatherFactory->getProvider($providerClass, $providerConfig);
$weatherData = $weatherProvider->getWeatherData();

$writersFactory = new \WeatherWriter\Writers\FileWritersFactory();
$weatherWriter = $writersFactory->getWriter($outputFormat, $appConfig->get('default_file_name'));

$weatherWriter->write($weatherData);

/**
 * Установка формата выходного файла
 * @param $allowedFormats
 * @return string
 * @throws Exception
 */
function setFormat($allowedFormats, $options) : string
{
    $outputFormat = 'xml';
    if (isset($options['format']) && !in_array($options['format'], $allowedFormats)) {
        throw new Exception('Указан некорректный формат файла');
    }

    if (isset($options['format'])) {
        $outputFormat = $options['format'];
    }

    return $outputFormat;
}