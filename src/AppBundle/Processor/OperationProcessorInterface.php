<?php

namespace AppBundle\Procesor;

interface OperationProcessorInterface
{
    /**
     * @param array $data
     *
     * @return float
     */
    public function getOperationFee(array $data) : float;
}
