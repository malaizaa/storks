<?php

namespace AppBundle\Model;

class Currency implements CurrencyInterface
{
    CONST CODE_EUR = 'EUR';
    CONST CODE_USD = 'USD';
    CONST CODE_JPY = 'JPY';

    /**
     * @var string
     */
    protected $code = self::CODE_EUR;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    public function getCode() : string
    {
        return $this->code;
    }
}
