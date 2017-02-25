<?php

namespace AppBundle\Model;

class NaturalCashOutOperation extends Operation
{
    /**
     * @var int
     */
    protected $weeklyOperationsCount = 0;

    /**
     * @var float
     */
    protected $weeklyOperationsSum = 0.00;

    /**
     * @return int
     */
    public function getWeeklyOperationsCount() : int
    {
        return $this->weeklyOperationsCount;
    }

    /**
     * @return float
     */
    public function getWeeklyOperationsSum() : float
    {
        return $this->weeklyOperationsSum;
    }

    /**
     * @param int $count
     *
     * @return self
     */
    public function setWeeklyOperationsCount(int $count)
    {
        $this->weeklyOperationsCount = $count;

        return $this;
    }

    /**
     * @param float $sum
     *
     * @return self
     */
    public function setWeeklyOperationsSum(float $sum)
    {
        $this->weeklyOperationsSum = $sum;

        return $this;
    }
}
