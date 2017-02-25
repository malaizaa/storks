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

    public function testItShouldReturnSupportedClientTypes()
    {
        $operation = $this->mockOperation();
        $clientTypes = [
            Operation::CLIENT_TYPE_NATURAL,
            Operation::CLIENT_TYPE_LEGAL,
        ];

        $this->assertEquals($clientTypes, $operation->getSupportedClientTypes());
    }

    public function testItKnowsThenCashIn()
    {
        $operation = $this->mockOperation();
        $this->assertTrue($operation->isCashInOperation());
        $operation->setType(Operation::OPERATION_TYPE_CASH_OUT);
        $this->assertFalse($operation->isCashInOperation());
    }

    public function testItKnowsThenCashOut()
    {
        $operation = new Operation(Operation::OPERATION_TYPE_CASH_OUT, 100, Currency::CODE_EUR, Operation::CLIENT_TYPE_LEGAL);
        $this->assertFalse($operation->isCashInOperation());
        $this->assertTrue($operation->isCashOutOperation());
    }

    public function testItKnowsThenLegalClient()
    {
        $operation = $this->mockOperation();
        $this->assertTrue($operation->isLegalClient());
    }

    /**
     * @dataProvider operationProvider
     */
    public function testItKnowsWhenLegalCashOutOperation($expecetedResult, Operation $operation)
    {
        $this->assertEquals($expecetedResult, $operation->isLegalCashOutOperation());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Unsuported operation type: any_non_suppoerted
     */
    public function testItShouldNotAcceptUnsupportedOpperation()
    {
        $operation = new Operation('any_non_suppoerted', 100, Currency::CODE_EUR, Operation::CLIENT_TYPE_LEGAL);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Unsuported client type: unsuported_client_type
     */
    public function testItShouldNotAcceptUnsupportedClientTypes()
    {
        $operation = new Operation(Operation::OPERATION_TYPE_CASH_OUT, 100, Currency::CODE_EUR, 'unsuported_client_type');
    }

    /**
     * @return array
     */
    public function operationProvider()
    {
        return [
            'cash_in_legal' => [false, $this->mockOperation(Operation::OPERATION_TYPE_CASH_IN, 100, Currency::CODE_EUR, Operation::CLIENT_TYPE_LEGAL)],
            'cash_in_natural' => [false, $this->mockOperation(Operation::OPERATION_TYPE_CASH_IN, 100, Currency::CODE_EUR, Operation::CLIENT_TYPE_NATURAL)],
            'cash_out_natural' => [false, $this->mockOperation(Operation::OPERATION_TYPE_CASH_OUT, 100, Currency::CODE_EUR, Operation::CLIENT_TYPE_NATURAL)],
            'cash_out_legal' => [true, $this->mockOperation(Operation::OPERATION_TYPE_CASH_OUT, 100, Currency::CODE_EUR, Operation::CLIENT_TYPE_LEGAL)],
        ];
    }

    /**
     * @return Operation
     */
    protected function mockOperation(
        $type = Operation::OPERATION_TYPE_CASH_IN,
        $amount = 100,
        $currency = Currency::CODE_EUR,
        $clientType = Operation::CLIENT_TYPE_LEGAL
    ) {
        return new Operation($type, $amount, $currency, $clientType);
    }
}
