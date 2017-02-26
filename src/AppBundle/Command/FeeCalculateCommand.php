<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AppBundle\Processor\CsvOperationProcessor;
use AppBundle\Util\Formatter;

class FeeCalculateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('storks:calculate-fees')
            ->addArgument('path', InputArgument::REQUIRED, 'path to csv file')
            ->setDescription('Calculates user operations fees from given csv file.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvProcessor = new CsvOperationProcessor();
        $formatter = new Formatter();
        if (false !== ($handle = fopen($input->getArgument('path'), 'r'))) {
            while (false !== ($data = fgetcsv($handle, 1000, ','))) {
                $commisionFee = $csvProcessor->getOperationFee($data);

                $output->writeln($formatter->format($commisionFee));
            }

            fclose($handle);
        }
    }
}
