<?php
namespace AppBundle\Processor;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Service\CurrencyConverter;
use AppBundle\Service\CashInFeeCalculator;
use AppBundle\Service\CashOutLegalFeeCalculator;
use AppBundle\Service\CashOutNaturalFeeCalculator;
use AppBundle\Model\Operation;
use AppBundle\Model\Currency;
use AppBundle\Model\NaturalCashOutOperation;

class CsvOperationProcessor
{
    /**
     * @var array
     */
    protected $userOperations;

    /**
     * @var CurrencyConverterInterface
     */
    protected $converter;

    public function __construct()
    {
        $this->userOperations = [];
        $this->converter = new CurrencyConverter();
    }

    /**
     * @param array $row
     *
     * @return float
     */
    public function getOperationFee(array $row) : float
    {
        $date = new \DateTime($row[0]);
        $userId = $row[1];
        $operationType = $row[3];
        $clientType = $row[2];
        $amount = $row[4];
        $currency = $row[5];
        $currencyIn = new Currency($currency);
        $currencyOut = new Currency(Currency::CODE_EUR);
        $weekNumber = $date->format('W');

        $operation = new Operation($operationType, $amount, $currency, $clientType);

        // keeps each user cash out operations grouped by week number
        $this->userOperations[$userId][$weekNumber][$operationType]['operations'][] = $row;

        // keeps each user cash out operations sum converted to default currency EUR
        $this->userOperations[$userId][$weekNumber][$operationType]['sum'][] = $this->converter->convert($currencyIn, $currencyOut, $amount);

        if ($operation->isCashInOperation()) {
            $calculator = new CashInFeeCalculator();

            return $calculator->calculate($operation);
        } else if ($operation->isLegalCashOutOperation()) {
            $calculator = new CashOutLegalFeeCalculator();

            return $calculator->calculate($operation);
        } else if ($operation->isNaturalCashOutOperation()) {
            $weeklyCashOutOperationsCount = count($this->userOperations[$userId][$weekNumber][$operationType]['operations']);
            $weeklyCashOutOperationsSum = array_sum($this->userOperations[$userId][$weekNumber][$operationType]['sum']);

            // construct new special NaturalCashOutOperation object
            $operation = new NaturalCashOutOperation($operationType, $amount, $currency, $clientType);
            $operation->setWeeklyOperationsCount($weeklyCashOutOperationsCount);
            $operation->setWeeklyOperationsSum($weeklyCashOutOperationsSum);

            $calculator = new CashOutNaturalFeeCalculator();

            return $calculator->calculate($operation);
        }

        return 0.00;
    }
}
