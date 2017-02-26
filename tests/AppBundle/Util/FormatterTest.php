<?php

namespace Tests\AppBundle\Util;

use AppBundle\Util\Formatter;

class FormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsFormatterInterface()
    {
        $formatter = new Formatter();

        $this->assertInstanceOf('\AppBundle\Util\FormatterInterface', $formatter);
    }

    /**
     * @dataProvider formatProvider
     */
    public function testConvert(float $amount, string $formattedResult)
    {
        $formatter = new Formatter();

        $this->assertEquals($formattedResult, $formatter->format($amount));
    }

    /**
     * @return array
     */
    public function formatProvider()
    {
        return [
            'format_two_digits_after_comma_1' => [10, '10.00'],
            'format_two_digits_after_comma_2' => [0.7, '0.70'],
            'format_two_digits_after_comma_3' => [10000, '10000.00'],
            'ceil_to_cents_1' => [0.061, '0.07'],
            'ceil_to_cents_2' => [0.001, '0.01'],
        ];
    }
}
