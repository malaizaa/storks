<?php
namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

class CashOutNaturalRateCalculator implements RateCalculatorInterface
{
    const RATE = 0.003;
    const FREE_AMOUNT = 1000;
    const FREE_OPERATIONS_COUNT = 4;

    public function calculate(OperationInterface $operation) : float
    {
        return $operation->getAmount() * self::RATE;
    }
}
