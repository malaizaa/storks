<?php
namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

class CashOutLegalRateCalculator implements RateCalculatorInterface
{
    const RATE = 0.003;
    const MIN_AMOUNT = 0.50;

    public function calculate(OperationInterface $operation) : float
    {
        return ($operation->getAmount() * self::RATE > self::MIN_AMOUNT) ? $operation->getAmount() * self::RATE : self::MIN_AMOUNT;
    }
}
