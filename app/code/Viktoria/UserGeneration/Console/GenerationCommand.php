<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 26.10.18
 * Time: 11:47
 */

namespace Viktoria\UserGeneration\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class GenerationCommand extends Command
{
    public const NUMBER_OF_USERS = 'number';

    /**
     * @var array $firstNames
     */
    private $firstNames = ['Emma', 'William', 'Sofia', 'Oliver', 'Henry'];

    /**
     * @var array $lastNames
     */
    private $lastNames = ['Nelson', 'Ross', 'Cox', 'Lopez', 'Perez'];

    /**
     * @var array $emailDomains
     */
    private $emailDomains = ['@gmail.com', '@yahoo.com', '@yandex.com', '@default-value.com.', '@hotmail.com'];

    /**
     * @return void
     */
    protected function configure(): void
    {
        $commandOptions = [
            new InputOption(
                self::NUMBER_OF_USERS,
                null,
                InputOption::VALUE_REQUIRED,
                'Number of accounts to generate'
            )
        ];

        $this->setName('customer:generate');
        $this->setDescription('Generation a customer');
        $this->setDefinition($commandOptions);
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->generateCustomers($input->getOption(self::NUMBER_OF_USERS), $output);
        return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
    }

    /**
     * @param $array
     * @return mixed
     * @throws \Exception
     */
    private function getRandomEl($array)
    {
        return $array[random_int(0, count($array) - 1)];
    }

    /**
     * @param int $count
     * @param OutputInterface $output
     * @return array
     * @throws \Exception
     */
    private function generateCustomers($count, $output): array
    {
        $customers = [];

        for ($i = 0; $i < $count; $i++) {
            $firstName = $this->getRandomEl($this->firstNames);
            $lastName = $this->getRandomEl($this->lastNames);
            $email = strtolower("{$firstName}_$lastName") . $this->getRandomEl($this->emailDomains);
            $customers[$i] = [
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'email'      => $email
            ];

//            if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
//                $output->writeln('Customer data:'. $firstName . ' '. $lastName. ' ' . $email);
//            }
            if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                $output->writeln('Customer data:');
                $output->writeln("> first name: $firstName");
                $output->writeln("> last name: $lastName");
                $output->writeln("> email: $email");
                $output->writeln('');
            }
        }

        return $customers;
    }
}