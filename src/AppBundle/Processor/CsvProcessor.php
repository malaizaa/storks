<?php
namespace AppBundle\Processor;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Service\CurrencyConverter;
use AppBundle\Service\CashInRateCalculator;
use AppBundle\Service\CashOutLegalRateCalculator;
use AppBundle\Service\CashOutNaturalRateCalculator;
use AppBundle\Model\Operation;
use AppBundle\Model\Currency;
use AppBundle\Model\NaturalCashOutOperation;

class CsvProcessor
{
    protected $userOperations;

    public function __construct()
    {
        $this->userOperations = [];
    }

    public function process($row)
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
        $converter = new CurrencyConverter();

        $operation = new Operation($operationType, $amount, $currency, $clientType);

        // keeps each user cash out operations grouped by week number
        $this->userOperations[$userId][$weekNumber][$operationType]['operations'][] = $row;

        // keeps each user cash out operations sum converted to default currency EUR
        $this->userOperations[$userId][$weekNumber][$operationType]['sum'][] = $converter->convert($currencyIn, $currencyOut, $amount);

        if ($operation->isCashInOperation()) {
            $calculator = new CashInRateCalculator();

            return $calculator->calculate($operation);
        } else if ($operation->isLegalCashOutOperation()) {
            $calculator = new CashOutLegalRateCalculator();

            return $calculator->calculate($operation);
        } else if ($operation->isNaturalCashOutOperation()) {
            $weeklyCashOutOperationsCount = count($this->userOperations[$userId][$weekNumber][$operationType]['operations']);
            $weeklyCashOutOperationsSum = array_sum($this->userOperations[$userId][$weekNumber][$operationType]['sum']);

            $operation = new NaturalCashOutOperation($operationType, $amount, $currency, $clientType);
            $operation->setWeeklyOperationsCount($weeklyCashOutOperationsCount);
            $operation->setWeeklyOperationsSum($weeklyCashOutOperationsSum);

            $calculator = new CashOutNaturalRateCalculator();

            return $calculator->calculate($operation);
        }

        return 0.00;
    }
}
