<?php

namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

interface RateCalculatorInterface
{
    /**
     * @param OperationInterface $amount
     *
     * @return float
     */
    public function calculate(OperationInterface $amount) : float;
}
