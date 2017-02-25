<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\CashOutNaturalRateCalculator;
use AppBundle\Model\OperationInterface;
use AppBundle\Model\Currency;
use AppBundle\Model\NaturalCashOutOperation;
use AppBundle\Model\Operation;

class CashOutNaturalRateCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsRateCalculatorInterface()
    {
        $this->assertInstanceOf('\AppBundle\Service\RateCalculatorInterface', new CashOutNaturalRateCalculator());
    }

    /**
     * @dataProvider operationsProvider
     */
    public function testCalculateRate($expectedResult, OperationInterface $operation)
    {
        $calculator = new CashOutNaturalRateCalculator();

        $this->assertEquals($expectedResult, $calculator->calculate($operation));
    }

    /**
     * @return array
     */
    public function operationsProvider() : array
    {
        return [
            'default rate'  => [
                0.3,
                new NaturalCashOutOperation(Operation::OPERATION_TYPE_CASH_IN, 100, Currency::CODE_JPY, Operation::CLIENT_TYPE_NATURAL)
            ],
            'min amount reached'  => [
                90.0,
                new NaturalCashOutOperation(Operation::OPERATION_TYPE_CASH_IN, 30000, Currency::CODE_EUR, Operation::CLIENT_TYPE_NATURAL)
            ],
        ];
    }
}
