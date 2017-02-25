<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\CurrencyConverter;
use AppBundle\Model\Currency;

class CurrencyConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsConverterInterface()
    {
        $this->assertInstanceOf('\AppBundle\Service\ConverterInterface', new CurrencyConverter());
    }

    /**
     * @dataProvider convertProvider
     */
    public function testConvert(Currency $currencyFrom, Currency $currencyTo, float $amount, float $convertedAmount)
    {
        $converter = new CurrencyConverter();

        $this->assertEquals($convertedAmount, $converter->convert($currencyFrom, $currencyTo, $amount));
    }

    /**
     * @return array
     */
    public function convertProvider()
    {
        return [
            'EUR_EUR' => [new Currency(Currency::CODE_EUR), new Currency(Currency::CODE_EUR), 10, 10],
            'EUR_USD' => [new Currency(Currency::CODE_EUR), new Currency(Currency::CODE_USD), 10, 11.497],
            'USD_EUR' => [new Currency(Currency::CODE_USD), new Currency(Currency::CODE_EUR), 10, 8.697921196833958],
            'EUR_JPY' => [new Currency(Currency::CODE_EUR), new Currency(Currency::CODE_JPY), 10, 1295.3],
            'JPY_EUR' => [new Currency(Currency::CODE_JPY), new Currency(Currency::CODE_EUR), 10, 0.077202192542268191],
            'USD_JPY' => [new Currency(Currency::CODE_USD), new Currency(Currency::CODE_JPY), 10, 1126.6417326259025],
            'JPY_USD' => [new Currency(Currency::CODE_JPY), new Currency(Currency::CODE_USD), 10, 0.088759360765845743],
        ];
    }
}
