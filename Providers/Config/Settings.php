<?php

namespace WeatherWriter\Providers\Config;

/**
 * Класс для работы с конфигурациями
 * Class Settings
 */
class Settings implements IConfig
{
    private $config;

    public function __construct($configFile)
    {
        $this->loadConfig($configFile);
    }

    /**
     * Загрузка конфигурации
     * @param $file
     * @throws \ErrorException
     */
    private function loadConfig($file)
    {
        if (!is_readable($file)) {
            throw new \ErrorException("Конфигурационный файл не найден");
        }

        $this->config = require_once $file;
    }

    /**
     * Получение указанного параметра
     * @param string $param_name наименование параметра
     * @return bool
     */
    public function get($param_name)
    {
        $paramLevels = explode('.',$param_name);
        $config = [];
        foreach ($paramLevels as $paramLevel) {
            if (empty($config)) {
                $config = $this->config[$paramLevel];
            } else {
                $config = $config[$paramLevel];
            }
        }

        if (isset($config)) {
            return $config;
        }

        return false;
    }
}