<?php

namespace AppBundle\Model;

interface OperationInterface
{
    /**
     * @return float
     */
    public function getAmount() : float;

    /**
     * @param float $amount
     *
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function setAmount(float $amount);

    /**
     * @return string
     */
    public function getCurrency() : string;

    /**
     * @param string $currency
     *
     * @return self
     */
    public function setCurrency(string $currency);

    /**
     * @param string $type
     *
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function setType(string $type);

    /**
     * @return string
     */
    public function getType() : string;

    /**
     * @return string
     *
     * @return self
     */
    public function getClientType() : string;

    /**
     * @param string $clientType
     *
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function setClientType(string $clientType);
}
