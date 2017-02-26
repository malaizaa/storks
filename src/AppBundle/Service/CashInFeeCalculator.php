<?php
namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

class CashInFeeCalculator implements FeeCalculatorInterface
{
    const Fee = 0.0003;
    const MAX_AMOUNT = 5.00;

    /**
     * @param OperationInterface $operation
     *
     * @return float
     */
    public function calculate(OperationInterface $operation) : float
    {
        return ($operation->getAmount() * self::Fee < self::MAX_AMOUNT) ? $operation->getAmount() * self::Fee : self::MAX_AMOUNT;
    }
}
