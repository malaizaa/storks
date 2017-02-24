<?php
namespace AppBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;

class CashOutNaturalRateCalculator
{
    const RATE = 0.003;
    const MIN_AMOUNT = 0.50;
    const FREE_AMOUNT = 1000;
    const FREE_OPERATIONS_COUNT = 4;

    public function calculate(float $amount, float $euroAmout, $weeklyOperationAmount, $weeklyOperationsCount) : float
    {
        return 0;
    }
}
