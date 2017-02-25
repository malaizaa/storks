<?php
// src/AppBundle/Command/CommisionRateCalculateCommand.php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use AppBundle\Processor\CsvProcessor;

/**
 * Coding standards demonstration.
 */
class CommisionRateCalculateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('storks:calculate-commisions')
            ->addArgument('path', InputArgument::REQUIRED, 'path to csv file')
            ->setDescription('Calculates user operations commisions from given csv file.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Commision rate calculator'
        ]);

        $csvProcessor = new CsvProcessor();

        if (false !== ($handle = fopen($input->getArgument('path'), 'r'))) {
            while (false !== ($data = fgetcsv($handle, 1000, ','))) {
                $output->writeln($csvProcessor->process($data));
            }

            fclose($handle);
        }
    }
}
