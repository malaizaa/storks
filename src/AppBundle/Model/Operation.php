<?php

namespace AppBundle\Model;

class Operation implements OperationInterface
{
    CONST OPERATION_TYPE_CASH_IN = 'cash_in';
    CONST OPERATION_TYPE_CASH_OUT = 'cash_out';

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $type;

    public function __construct(string $type, float $amount, string $currency)
    {
        $this->setType($type);
        $this->setCurrency($currency);
        $this->setAmount($amount);
    }

    /**
     * @return $amount
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @param float $amount
     *
     * @return self
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param string $currency
     *
     * @return self
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function setType(string $type)
    {
        if (! in_array($type, $this->getSupportedOperations())) {
            throw new \InvalidArgumentException(sprintf('Unsuported operation type: %s', $type));
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     */
    public function getSupportedOperations() : array
    {
        return [
            self::OPERATION_TYPE_CASH_IN,
            self::OPERATION_TYPE_CASH_OUT
        ];
    }

    /**
     * @return bool
     */
    public function isCashInOperation() : bool
    {
        return ($this->getType() === self::OPERATION_TYPE_CASH_IN);
    }
}
