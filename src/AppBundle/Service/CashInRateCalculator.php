<?php
namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

class CashInRateCalculator implements RateCalculatorInterface
{
    const RATE = 0.0003;
    const MAX_AMOUNT = 5.00;

    /**
     * @param OperationInterface $operation
     *
     * @return float
     */
    public function calculate(OperationInterface $operation) : float
    {
        return ($operation->getAmount() * self::RATE < self::MAX_AMOUNT) ? $operation->getAmount() * self::RATE : self::MAX_AMOUNT;
    }
}
