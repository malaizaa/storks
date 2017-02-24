<?php

namespace AppBundle\Model;

class Currency implements CurrencyInterface
{
    CONST CODE_EUR = 'EUR';
    CONST CODE_USD = 'USD';
    CONST CODE_JPN = 'JPN';
    
    /**
     * @var string
     */
    protected $code;

    public function setCode(string $code) : CurrencyInterface
    {
        $this->code = $code;

        return $this;
    }

    public function getCode() : string
    {
        return $this->code;
    }
}
