<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 02.11.18
 * Time: 10:33
 */

namespace Viktoria\UserGeneration\Console;

use Symfony\Component\Console\Command\Command;

class AddDefaultAddress extends Command
{
    protected function configure()
    {
//        $commandoptions = [
//            new InputOption($this->num,
//                null,
//                InputOption::VALUE_REQUIRED,
//                'Number'
//            )
//        ];

        $this->setName('customer:addDefaultAddress');
        $this->setDescription('Adding default shipping and billing addresses if the customer did not add the address');
//        $this->setDefinition($commandoptions);
        parent::configure();
    }
}