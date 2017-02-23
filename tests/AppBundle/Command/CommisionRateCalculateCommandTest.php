<?php

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Command\CommisionRateCalculateCommand;

class CommisionRateCalculateCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new CommisionRateCalculateCommand());

        $command = $application->find('storks:calculate-commisions');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'path' => $kernel->getRootDir().'/../tests/input.csv',
        ));

        $output = $commandTester->getDisplay();
        $this->assertContains($this->getExpectedOutput($kernel), $output);
    }

    /**
     * @param AppKernel $kernel
     *
     * @return string
     */
    protected function getExpectedOutput(AppKernel $kernel) : string
    {
        return file_get_contents($kernel->getRootDir().'/../tests/output.csv');
    }
}
