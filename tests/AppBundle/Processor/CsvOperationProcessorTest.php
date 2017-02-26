<?php

namespace Tests\AppBundle\Model;

use AppBundle\Model\Operation;
use AppBundle\Model\Currency;
use AppBundle\Processor\CsvOperationProcessor;

class CsvOperationTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsOperationInterface()
    {
        $this->assertInstanceof('\AppBundle\Processor\OperationProcessorInterface', new CsvOperationProcessor());
    }

    /**
     * @dataProvider dataProvider
     */
    public function testItCountFeesByCsvData(float $expectedFee, array $data)
    {
        $processor = new CsvOperationProcessor();
        $this->assertEquals($expectedFee, $processor->getOperationFee($data));
    }

    /**
     * @return array
     */
    public function dataProvider() : array
    {
        return [
            'cash_in_operation' => [0.06, [
                0 =>'2016-01-05',
                1 => '1',
                2 => 'natural',
                3 => 'cash_in',
                4 => 200.00,
                5 => 'EUR'
            ]],
            'cash_out_legal_operation' => [0.9, [
                0 =>'2016-01-05',
                1 => '2',
                2 => 'legal',
                3 => 'cash_out',
                4 => 300.00,
                5 => 'EUR'
            ]],
            'cash_out_natural_operation' => [0.0, [
                0 =>'2016-01-05',
                1 => '2',
                2 => 'natural',
                3 => 'cash_out',
                4 => 300.00,
                5 => 'EUR'
            ]],
        ];
    }
}
