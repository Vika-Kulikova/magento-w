<?php

namespace Viktoria\GenerateCustomer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCustomer extends Command
{
    public const INPUT_OPTION_QUANTITY = 'generate-customers-quantity';

    /**
     * @var \Viktoria\GenerateCustomer\Helper\Customer $customerHelper
     */
    private $customerHelper;

    /**
     * CustomerCreateCommand constructor.
     * @param \Viktoria\GenerateCustomer\Helper\Customer $customerHelper
     */
    public function __construct(\Viktoria\GenerateCustomer\Helper\Customer $customerHelper)
    {
        $this->customerHelper = $customerHelper;
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('customer:user:create')
            ->setDescription('Create new customer')
            ->addOption(
                self::INPUT_OPTION_QUANTITY,
                null,
                InputOption::VALUE_REQUIRED,
                'Number of customers to generated',
                5
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Creating new user...</info>');
        $qtyToGenerate = (int) $input->getOption(self::INPUT_OPTION_QUANTITY);
        $customers = $this->customerHelper->generateCustomers($qtyToGenerate);

        /** @var \Magento\Customer\Model\Customer $customer */
        foreach ($customers as $customer) {
            $output->writeln('');
            $output->writeln('<info>User created with the following data:</info>');
            $output->writeln("<comment>Customer First Name: {$customer->getFirstname()}</comment>");
            $output->writeln("<comment>Customer Last Name: {$customer->getLastname()}</comment>");
            $output->writeln('');
            $output->writeln("<comment>Customer Email: {$customer->getEmail()}</comment>");
        }
    }
}
