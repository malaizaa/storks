<?php

namespace Tests\AppBundle\Model;

use AppBundle\Model\Operation;
use AppBundle\Model\Currency;

class OperationTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsOperationInterface()
    {
        $operation = $this->mockOperation();

        $this->assertInstanceOf('\AppBundle\Model\OperationInterface', $operation);
    }

    public function testItShouldConstructObjectWithDefaultValues()
    {
        $operation = $this->mockOperation();
        $this->assertEquals(Operation::OPERATION_TYPE_CASH_IN, $operation->getType());
        $this->assertEquals(100, $operation->getAmount());
        $this->assertEquals(Currency::CODE_EUR, $operation->getCurrency());
    }

    public function testItShouldReturnSupportedOperations()
    {
        $operation = $this->mockOperation();
        $operations = [
            Operation::OPERATION_TYPE_CASH_IN,
            Operation::OPERATION_TYPE_CASH_OUT
        ];

        $this->assertEquals($operations, $operation->getSupportedOperations());
    }

    public function testItKnowsThenCashIn()
    {
        $operation = $this->mockOperation();
        $this->assertTrue($operation->isCashInOperation());
        $operation->setType(Operation::OPERATION_TYPE_CASH_OUT);
        $this->assertFalse($operation->isCashInOperation());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testItShouldNotAcceptUnsupportedOpperation()
    {
        $operation = new Operation('any_non_suppoerted', 100, Currency::CODE_EUR);
    }

    /**
     * @return Operation
     */
    protected function mockOperation()
    {
        return new Operation(Operation::OPERATION_TYPE_CASH_IN, 100, Currency::CODE_EUR);
    }
}
