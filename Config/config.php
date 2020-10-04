<?php

return [
    'active_weather_provider' => [
        'class' => 'OpenWeatherProvider',
        'config' => __DIR__ . DIRECTORY_SEPARATOR
            . 'weather-providers' . DIRECTORY_SEPARATOR
            . 'open-weather' . DIRECTORY_SEPARATOR . 'config.php'
    ],
    'allowed_formats' => ['xml', 'json'],
    'default_file_name' => 'weather_data'
];

