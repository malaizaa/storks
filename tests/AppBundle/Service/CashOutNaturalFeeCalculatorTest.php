<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\CashOutNaturalFeeCalculator;
use AppBundle\Model\OperationInterface;
use AppBundle\Model\Currency;
use AppBundle\Model\NaturalCashOutOperation;
use AppBundle\Model\Operation;

class CashOutNaturalFeeCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsFeeCalculatorInterface()
    {
        $this->assertInstanceOf('\AppBundle\Service\FeeCalculatorInterface', new CashOutNaturalFeeCalculator());
    }

    /**
     * @dataProvider operationsProvider
     */
    public function testCalculateFee($expectedResult, OperationInterface $operation)
    {
        $calculator = new CashOutNaturalFeeCalculator();

        $this->assertEquals($expectedResult, $calculator->calculate($operation));
    }

    /**
     * @return array
     */
    public function operationsProvider() : array
    {
        return [
            'first week operation'  => [0, $this->mockOperation(100, Currency::CODE_JPY, 1, 0)],
            'second week operation'  => [0, $this->mockOperation(100, Currency::CODE_EUR, 2, 400)],
            'third week operation wiht free amount reached'  => [0.30, $this->mockOperation(1000, Currency::CODE_EUR, 3, 1100)],
            'forth week operation'  => [0.90, $this->mockOperation(300, Currency::CODE_EUR, 4, 800)],
        ];
    }

    /**
     * @param float $amount
     * @param string $currency
     * @param int $weeklyOperationsCount
     * @param float $weeklyOperationsSum
     *
     * @return NaturalCashOutOperation
     */
    protected function mockOperation($amount, $currency, $weeklyOperationsCount, $weeklyOperationsSum)
    {
        $operation = new NaturalCashOutOperation(Operation::OPERATION_TYPE_CASH_OUT, $amount, $currency, Operation::CLIENT_TYPE_NATURAL);
        $operation->setWeeklyOperationsSum($weeklyOperationsSum);
        $operation->setWeeklyOperationsCount($weeklyOperationsCount);

        return $operation;
    }
}
