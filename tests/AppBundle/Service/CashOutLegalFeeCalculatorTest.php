<?php

namespace Tests\AppBundle\Service;

use AppBundle\Model\OperationInterface;
use AppBundle\Model\Currency;
use AppBundle\Model\Operation;
use AppBundle\Service\CashOutLegalFeeCalculator;

class CashOutLegalFeeCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsRateCalculatorInterface()
    {
        $this->assertInstanceOf('\AppBundle\Service\RateCalculatorInterface', new CashOutLegalFeeCalculator());
    }

    /**
     * @dataProvider operationsProvider
     */
    public function testCalculateRate($expectedResult, OperationInterface $operation)
    {
        $calculator = new CashOutLegalFeeCalculator();

        $this->assertEquals($expectedResult, $calculator->calculate($operation));
    }

    /**
     * @return array
     */
    public function operationsProvider() : array
    {
        return [
            'default rate'  => [
                0.5,
                new Operation(Operation::OPERATION_TYPE_CASH_IN, 100, Currency::CODE_JPY, Operation::CLIENT_TYPE_LEGAL)
            ],
            'min amount reached'  => [
                90.0,
                new Operation(Operation::OPERATION_TYPE_CASH_IN, 30000, Currency::CODE_EUR, Operation::CLIENT_TYPE_LEGAL)
            ],
        ];
    }
}
