<?php
namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

class CashOutLegalFeeCalculator implements FeeCalculatorInterface
{
    const FEE = 0.003;
    const MIN_AMOUNT = 0.50;

    public function calculate(OperationInterface $operation) : float
    {
        return ($operation->getAmount() * self::FEE > self::MIN_AMOUNT) ? $operation->getAmount() * self::FEE : self::MIN_AMOUNT;
    }
}
