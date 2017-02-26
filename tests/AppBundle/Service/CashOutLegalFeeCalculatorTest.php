<?php

namespace Tests\AppBundle\Service;

use AppBundle\Model\OperationInterface;
use AppBundle\Model\Currency;
use AppBundle\Model\Operation;
use AppBundle\Service\CashOutLegalFeeCalculator;

class CashOutLegalFeeCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider operationsProvider
     */
    public function testCalculateRate($expectedResult, OperationInterface $operation)
    {
        $calculator = new CashOutLegalFeeCalculator();

        $this->assertEquals($expectedResult, $calculator->calculate($operation));
    }

    public function testImplementsRateCalculatorInterface()
    {
        $this->assertInstanceOf('\AppBundle\Service\FeeCalculatorInterface', new CashOutLegalFeeCalculator());
    }

    /**
     * @return array
     */
    public function operationsProvider() : array
    {
        return [
            'min amount not reached'  => [
                0.5,
                new Operation(Operation::OPERATION_TYPE_CASH_IN, 100, Currency::CODE_JPY, Operation::CLIENT_TYPE_LEGAL)
            ],
            'default rate'  => [
                90.0,
                new Operation(Operation::OPERATION_TYPE_CASH_IN, 30000, Currency::CODE_EUR, Operation::CLIENT_TYPE_LEGAL)
            ],
        ];
    }
}
