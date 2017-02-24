<?php

namespace AppBundle\Model;

interface CurrencyInterface {

    /**
     * @return string
     */
    public function getCode() : string;

    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode(string $code) : self;
}
