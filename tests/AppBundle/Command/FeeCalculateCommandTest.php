<?php

namespace Tests\AppBundle\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Command\FeeCalculateCommand;

class FeeCalculateCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new FeeCalculateCommand());

        $command = $application->find('storks:calculate-fees');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'path' => $kernel->getRootDir().'/../tests/input.csv',
        ));

        $output = $commandTester->getDisplay();
        $this->assertContains($this->getExpectedOutput($kernel), $output);
    }

    /**
     * @param Symfony\Component\HttpKernel\KernelInterface $kernel
     *
     * @return string
     */
    protected function getExpectedOutput(\Symfony\Component\HttpKernel\KernelInterface $kernel) : string
    {
        return file_get_contents($kernel->getRootDir().'/../tests/output.csv');
    }
}
