<?php
namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

class CashOutNaturalFeeCalculator implements FeeCalculatorInterface
{
    const FEE = 0.003;
    const FREE_AMOUNT = 1000;
    const FREE_OPERATIONS_COUNT = 3;

    /**
     * @param OperationInterface $operation
     *
     * @return float
     */
    public function calculate(OperationInterface $operation) : float
    {
        // is weekly operation limit reached, apply default Fee
        if ($operation->getWeeklyOperationsCount() > self::FREE_OPERATIONS_COUNT) {
            return $operation->getAmount() * self::FEE;
        }

        // is weekly operation free amount limit reached, apply default Fee
        $operationsSumBeforeOperation = $operation->getWeeklyOperationsSum() - $operation->getAmount();
        if ($operation->getWeeklyOperationsSum() > self::FREE_AMOUNT) {
            //1200, 800,
            if ($operationsSumBeforeOperation <= self::FREE_AMOUNT) {
                return ($operation->getWeeklyOperationsSum() - self::FREE_AMOUNT) * self::FEE;
            }

            return $operation->getAmount() * self::FEE;
        }

        // if user is not reached weekly limit when operations is for free
        return 0.00;
    }
}
