<?php
namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

class CashOutNaturalRateCalculator implements RateCalculatorInterface
{
    const RATE = 0.003;
    const FREE_AMOUNT = 1000;
    const FREE_OPERATIONS_COUNT = 3;

    /**
     * @param OperationInterface $operation
     *
     * @return float
     */
    public function calculate(OperationInterface $operation) : float
    {
        // is weekly operation limit reached, apply default rate
        if ($operation->getWeeklyOperationsCount() > self::FREE_OPERATIONS_COUNT) {
            return $operation->getAmount() * self::RATE;
        }

        // is weekly operation free amount limit reached, apply default rate
        if ($operation->getWeeklyOperationsSum() >= self::FREE_AMOUNT) {
            return $operation->getAmount() * self::RATE;
        }

        // if user is not reached weekly limit when operations is for free
        return 0.00;
    }
}
