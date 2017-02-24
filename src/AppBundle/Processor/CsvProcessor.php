<?php
namespace AppBundle\Processor;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Service\CashInRateCalculator;
use AppBundle\Model\Operation;

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
        $type = $row[2];
        $amount = $row[4];
        $currency = $row[5];
        $weekNumber = $date->format('W');

        $operation = new Operation($operationType, $amount, $currency);

        // keeps each user operations grouped by week number
        $this->userOperations[$userId][$weekNumber][$operationType]['operations'][] = $row;

        if ($operation->isCashInOperation()) {
            $calculator = new CashInRateCalculator();

            return $calculator->calculate($operation);
        }

        return 0.00;
    }
}
