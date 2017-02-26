<?php

namespace AppBundle\Processor;

interface OperationProcessorInterface
{
    /**
     * @param array $data
     *
     * @return float
     */
    public function getOperationFee(array $data) : float;
}
