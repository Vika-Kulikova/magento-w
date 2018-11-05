<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 25.10.18
 * Time: 10:38
 */

namespace Viktoria\AddCustomer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class Sayhello extends Command
{
    const CUSTOMERNAME = 'Name';

    protected function configure()
    {
        $commandoptions = [
            new InputOption(self::CUSTOMERNAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            )
        ];

        $this->setName('example:sayhello');
        $this->setDescription('Demo command line');
        $this->setDefinition($commandoptions);
//        $this->addArgument('number', InputArgument::REQUIRED, __('Type a number'));
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($customername=$input->getOption(self::CUSTOMERNAME))
        {
            $output->writeln("Hi ".$customername);
//            $output->writeln("I will double your number:");
//            $output->writeln($input->getArgument('number')*2);
        }
        else {
            $output->writeln("Hi Customer");
        }
    }
}