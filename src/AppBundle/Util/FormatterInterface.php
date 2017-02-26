<?php

namespace AppBundle\Util;

interface FormatterInterface
{
    /**
     * @param float $amount
     *
     * @return string
     */
    public function format(float $amount);
}
