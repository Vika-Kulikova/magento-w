<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 25.10.18
 * Time: 11:11
 */

namespace Viktoria\AddCustomer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

use Magento\User\Model\UserValidationRules;
use Symfony\Component\Console\Question\Question;

class UserCreateCommand extends Command
{
    const USER_FIRST_NAME = 'customer-firstname';
    const USER_LAST_NAME = 'customer-lastname';
    const USER_PASSWORD = 'customer-password';
    const USER_EMAIL = 'customer-email';
    const USER_ADDRESS = 'customer-address';

    private $validationRules;

    public function __construct(UserValidationRules $validationRules)
    {
        $this->validationRules = $validationRules;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('customer:create');
        $this->setDescription('Creates an customer');
        $this->setDefinition($this->getOptionsList());
        parent::configure();
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        /** @var \Symfony\Component\Console\Helper\QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');

        if (!$input->getOption(self::USER_FIRST_NAME)) {
            $question = new Question('<question>Customer name:</question> ', '');
            $this->addNotEmptyValidator($question);

            $input->setOption(
                self::USER_FIRST_NAME,
                $questionHelper->ask($input, $output, $question)
            );
        }

        if (!$input->getOption(self::USER_LAST_NAME)) {
            $question = new Question('<question>Customer surname:</question> ', '');
            $this->addNotEmptyValidator($question);

            $input->setOption(
                self::USER_LAST_NAME,
                $questionHelper->ask($input, $output, $question)
            );
        }

        if (!$input->getOption(self::USER_PASSWORD)) {
            $question = new Question('<question>Customer password:</question> ', '');
            $question->setHidden(true);

            $question->setValidator(function ($value) use ($output) {
                $user = new \Magento\Framework\DataObject();
                $user->setPassword($value);

                $validator = new \Magento\Framework\Validator\DataObject();
                $this->validationRules->addPasswordRules($validator);

                $validator->isValid($user);
                foreach ($validator->getMessages() as $message) {
                    throw new \Exception($message);
                }

                return $value;
            });

            $input->setOption(
                self::USER_PASSWORD,
                $questionHelper->ask($input, $output, $question)
            );
        }

        if (!$input->getOption(self::USER_EMAIL)) {
            $question = new Question('<question>Customer email:</question> ', '');
            $this->addNotEmptyValidator($question);

            $input->setOption(
                self::USER_EMAIL,
                $questionHelper->ask($input, $output, $question)
            );
        }

        if (!$input->getOption(self::USER_ADDRESS)) {
            $question = new Question('<question>Customer address:</question> ', '');
            $this->addNotEmptyValidator($question);

            $input->setOption(
                self::USER_ADDRESS,
                $questionHelper->ask($input, $output, $question)
            );
        }
    }

    /**
     * @param \Symfony\Component\Console\Question\Question $question
     * @return void
     */
    private function addNotEmptyValidator(Question $question)
    {
        $question->setValidator(function ($value) {
            if (trim($value) == '') {
                throw new \Exception('The value cannot be empty');
            }

            return $value;
        });
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $errors = $this->validate($input);
//        if ($errors) {
//            $output->writeln('<error>' . implode('</error>' . PHP_EOL . '<error>', $errors) . '</error>');
//            // we must have an exit code higher than zero to indicate something was wrong
//            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
//        }
//        $installer = $this->installerFactory->create(new ConsoleLogger($output));
//        $installer->installAdminUser($input->getOptions());
        $output->writeln(
            '<info>Created customer user named ' . $input->getOption(self::USER_FIRST_NAME) . $input->getOption(self::USER_LAST_NAME) . '</info>'
        );
        return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
    }

    public function getOptionsList()
    {
        return [
            new InputOption(
                self::USER_FIRST_NAME,
                null, InputOption::VALUE_REQUIRED,
                '(Required) Customer first name'
            ),
            new InputOption(
                self::USER_LAST_NAME,
                null,
                InputOption::VALUE_REQUIRED,
                '(Required) Customer last name'
            ),
            new InputOption(
                self::USER_PASSWORD,
                null,
                InputOption::VALUE_REQUIRED,
                '(Required) Customer password'
            ),
            new InputOption(
                self::USER_EMAIL,
                null,
                InputOption::VALUE_REQUIRED,
                '(Required) Customer email'
            ),
            new InputOption(
                self::USER_ADDRESS,
                null,
                InputOption::VALUE_REQUIRED,
                '(Required) Customer address'
            ),

        ];
    }

    /**
     * Check if all admin options are provided
     *
     * @param InputInterface $input
     * @return string[]
     */
//    public function validate(InputInterface $input)
//    {
//        $errors = [];
//        $user = new \Magento\Framework\DataObject();
//        $user->setFirstname($input->getOption(AdminAccount::KEY_FIRST_NAME))
//            ->setLastname($input->getOption(AdminAccount::KEY_LAST_NAME))
//            ->setUsername($input->getOption(AdminAccount::KEY_USER))
//            ->setEmail($input->getOption(AdminAccount::KEY_EMAIL))
//            ->setPassword(
//                $input->getOption(AdminAccount::KEY_PASSWORD) === null
//                    ? '' : $input->getOption(AdminAccount::KEY_PASSWORD)
//            );
//
//        $validator = new \Magento\Framework\Validator\DataObject();
//        $this->validationRules->addUserInfoRules($validator);
//        $this->validationRules->addPasswordRules($validator);
//
//        if (!$validator->isValid($user)) {
//            $errors = array_merge($errors, $validator->getMessages());
//        }
//
//        return $errors;
//    }
}