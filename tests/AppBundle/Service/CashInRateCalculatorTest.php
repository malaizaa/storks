<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\CashInRateCalculator;
use AppBundle\Model\OperationInterface;
use AppBundle\Model\Currency;
use AppBundle\Model\Operation;

class CashInRateCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsRateCalculatorInterface()
    {
        $this->assertInstanceOf('\AppBundle\Service\RateCalculatorInterface', new CashInRateCalculator());
    }

    /**
     * @dataProvider operationsProvider
     */
    public function testCalculateRate($expectedResult, OperationInterface $operation)
    {
        $calculator = new CashInRateCalculator();

        $this->assertEquals($expectedResult, $calculator->calculate($operation));
    }

    /**
     * @return array
     */
    public function operationsProvider() : array
    {
        return [
            'default rate'  => [
                0.03, new Operation(Operation::OPERATION_TYPE_CASH_IN, 100, Currency::CODE_JPY, Operation::CLIENT_TYPE_LEGAL)
            ],
            'max amount reached'  => [
                5.00, new Operation(Operation::OPERATION_TYPE_CASH_IN, 30000, Currency::CODE_EUR, Operation::CLIENT_TYPE_LEGAL)
            ],
        ];
    }
}
