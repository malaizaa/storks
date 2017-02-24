<?php
namespace AppBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Model\CurrencyInterface;

class CurrencyConverter implements ConverterInterface
{
    /**
     * @param CurrencyInterface $currencyFrom
     * @param CurrencyInterface $currencyTo
     * @param float $amount
     *
     * @return float
     */
    public function convert(CurrencyInterface $currencyFrom, CurrencyInterface $currencyTo, float $amount) : float
    {
        return $amount * (self::rates()[$currencyTo->getCode()] / self::rates()[$currencyFrom->getCode()]);
    }

    public static function rates() : array
    {
        return [
            'EUR' => 1, // default currency
            'JPY' => 129.53,
            'USD' => 1.1497
        ];
    }
}
