<?php
namespace AppBundle\Util;

class Formatter implements FormatterInterface
{
    /**
     * @param float $amount
     *
     * @return string
     */
    public function format(float $amount)
    {
        return number_format(ceil($amount * 100) / 100, 2, '.', '');
    }
}
