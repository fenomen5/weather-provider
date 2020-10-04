<?php

namespace WeatherWriter\Providers\Weather;

use PHPUnit\Framework\TestCase;
use WeatherWriter\Providers\Config\Settings;

class WeatherProviderFactoryTest extends TestCase
{
    protected function setUp(): void
    {
        require 'loader.php';
    }

    /**
     * Проверка класса созданного провайдера фабрикой
     * @dataProvider getProviderDataProvider
     */
    public function testGetProvider($class, $providerName)
    {
        $providerFactory = new WeatherProviderFactory();
        $config = $this->createMock(Settings::class);
        $config->method('get')->willReturn([]);

        $provider = $providerFactory->getProvider($class, $config);

        $reflect = new \ReflectionClass($provider);
        $this->assertEquals($providerName, $reflect->getShortName());
    }

    /**
     * Провайдер данных для тестовгого метода
     * @return \string[][]
     */
    public function getProviderDataProvider()
    {
        return [['OpenWeatherProvider', 'WeatherProvider']];
    }
}