<?php

namespace AppBundle\Service;

use AppBundle\Model\CurrencyInterface;

interface ConverterInterface
{
    /**
     * @param CurrencyInterface $currencyFrom
     * @param CurrencyInterface $currencyTo
     * @param float $amount
     *
     * @return float
     */
    public function convert(CurrencyInterface $currencyFrom, CurrencyInterface $currencyTo, float $amount) : float;
}
