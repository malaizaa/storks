<?php

namespace AppBundle\Model;

class Operation implements OperationInterface
{
    CONST OPERATION_TYPE_CASH_IN = 'cash_in';
    CONST OPERATION_TYPE_CASH_OUT = 'cash_out';

    CONST CLIENT_TYPE_LEGAL = 'legal';
    CONST CLIENT_TYPE_NATURAL = 'natural';

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

    /**
     * @var string
     */
    protected $clientType;

    public function __construct(string $type, float $amount, string $currency, string $clientType)
    {
        $this->setType($type);
        $this->setCurrency($currency);
        $this->setAmount($amount);
        $this->setClientType($clientType);
    }

    /**
     * @return float
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
     * @return string
     */
    public function getClientType() : string
    {
        return $this->clientType;
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
     * @param string $clientType
     *
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public function setClientType(string $clientType)
    {
        if (! in_array($clientType, $this->getSupportedClientTypes())) {
            throw new \InvalidArgumentException(sprintf('Unsuported client type: %s', $clientType));
        }

        $this->clientType = $clientType;

        return $this;
    }

    /**
     * @return array
     */
    public function getSupportedOperations() : array
    {
        return [
            self::OPERATION_TYPE_CASH_IN,
            self::OPERATION_TYPE_CASH_OUT,
        ];
    }

    /**
     * @return array
     */
    public function getSupportedClientTypes() : array
    {
        return [
            self::CLIENT_TYPE_NATURAL,
            self::CLIENT_TYPE_LEGAL,
        ];
    }

    /**
     * @return bool
     */
    public function isLegalClient() : bool
    {
        return ($this->getClientType() === self::CLIENT_TYPE_LEGAL);
    }

    /**
     * @return bool
     */
    public function isLegalCashOutOperation() : bool
    {
        return ($this->isLegalClient() && $this->isCashOutOperation());
    }

    /**
     * @return bool
     */
    public function isCashInOperation() : bool
    {
        return ($this->getType() === self::OPERATION_TYPE_CASH_IN);
    }

    /**
     * @return bool
     */
    public function isCashOutOperation() : bool
    {
        return ($this->getType() === self::OPERATION_TYPE_CASH_OUT);
    }
}
