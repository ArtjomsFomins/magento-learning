<?php
namespace Learning\Brand\Plugin;

use Closure;
use Learning\Brand\Console\Command\AddItem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Logger
{
    private $output;

    public function beforeRun(AddItem $command, InputInterface $input, OutputInterface $output)
    {
        $output->writeln('beforeExecute');
    }

    public function aroundRun(AddItem $command, Closure $procced, InputInterface $input, OutputInterface $output)
    {
        $output->writeln('aroundExecuteBeforeRun');
        $procced->call($command, $input, $output);
        $output->writeln('aroundExecuteAfterCall');
        $this->output = $output;
    }

    public function afterRun(AddItem $command)
    {
        $this->output->writeln('afterExecute');
    }
}
