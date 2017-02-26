<?php

namespace AppBundle\Service;

use AppBundle\Model\OperationInterface;

interface FeeCalculatorInterface
{
    /**
     * @param OperationInterface $amount
     *
     * @return float
     */
    public function calculate(OperationInterface $amount) : float;
}
