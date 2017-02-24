<?php
namespace AppBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;

class CashOutLegalRateCalculator implements RateCalculatorInterface
{
    const RATE = 0.003;
    const MIN_AMOUNT = 0.50;

    public function calculate(float $amount) : float
    {
        return ($amount * self::RATE > self::MIN_AMOUNT) ? $amount * self::RATE : self::MIN_AMOUNT;
    }
}
