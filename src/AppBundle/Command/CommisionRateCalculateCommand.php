<?php
// src/AppBundle/Command/CommisionRateCalculateCommand.php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Coding standards demonstration.
 */
class CommisionRateCalculateCommand extends Command
{
    protected function configure()
    {
        $this
           ->setName('storks:calculate-commisions')
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
    }
}
