<?php

namespace Viktoria\GenerateCustomer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Magento\Customer\Api\Data\RegionInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class AddDefaultAddress extends Command
{
    public const INPUT_CUSTOMER_ID = 'customer-id';
    /**
     * @var \Magento\Framework\App\State $state
     */
    private $state;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var \Magento\Customer\Api\Data\AddressInterfaceFactory
     */
    private $addressDataFactory;

    /**
     * @var \Magento\Customer\Api\AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * @var \Magento\Customer\Api\Data\RegionInterfaceFactory
     */
    private $regionFactory;

    /**
     * AddDefaultAddress constructor.
     * @param \Magento\Framework\App\State $state
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param \Magento\Customer\Api\Data\AddressInterfaceFactory $addressDataFactory
     * @param \Magento\Customer\Api\AddressRepositoryInterface $addressRepository
     * @param \Magento\Customer\Api\Data\RegionInterfaceFactory $regionFactory
     * @param null $name
     */
    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Api\Data\AddressInterfaceFactory $addressDataFactory,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Magento\Customer\Api\Data\RegionInterfaceFactory $regionFactory,
        $name = null
    )
    {
        parent::__construct($name);
        $this->state = $state;
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->addressDataFactory = $addressDataFactory;
        $this->regionFactory = $regionFactory;
    }

    /**
     * @inheritdoc
     */
    protected function configure(): void
    {
        $this->setName('add:default:address')
            ->setDescription('Adding default billing and shipping')
            ->addOption(
                self::INPUT_CUSTOMER_ID,
                null,
                InputOption::VALUE_REQUIRED,
                'Name of the user in who checking the address'
            );
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = (int)$input->getOption(self::INPUT_CUSTOMER_ID);
        $customer = $this->getCustomerById($id);
        $address = $this->addDefaultAddress($id);
        $street = implode(" | ", $address->getStreet());

        $output->writeln("<comment>Customer's ID: {$id}</comment>");
        $output->writeln("<comment>Customer First Name: {$customer->getFirstname()}</comment>");
        $output->writeln("<comment>Customer Last Name: {$customer->getLastname()}</comment>");
        $output->writeln("<comment>Customer Email: {$customer->getEmail()}</comment>\n");
        $output->writeln("<comment>Customer Billing Address ID: {$customer->getDefaultBilling()}</comment>");
        $output->writeln("<comment>Customer Shipping Address ID: {$customer->getDefaultShipping()}</comment>\n");
//        $output->writeln("<comment>Customer Address: {$customer->getAddresses()[0]->getStreet()[0]}</comment>\n");

        $output->writeln("<comment>Address Billing Address ID: {$address->getId()}</comment>\n");
        $output->writeln("<comment>Address Billing Address:\n {$street} </comment>\n");
        $output->writeln("<comment>Address Shipping Address ID: {$address->getId()}</comment>\n");
        $output->writeln("<comment>Customer Shipping Address:\n {$address->getStreet()[0]} \n {$address->getCity()}, {$address->getRegion()->getRegion()}, {$address->getPostcode()} \n {$address->getCountryId()}</comment>");
    }

    /**
     * @param $id
     * @return \Magento\Customer\Api\Data\CustomerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getCustomerById($id): \Magento\Customer\Api\Data\CustomerInterface
    {
        return $this->customerRepository->getById($id);
    }

    /**
     * @param $id
     * @return \Magento\Customer\Api\Data\AddressInterface
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function addDefaultAddress($id): \Magento\Customer\Api\Data\AddressInterface
    {
        $this->state->setAreaCode('frontend');
        $customer = $this->getCustomerById($id);

        if ($customer->getDefaultShipping() === null) {
            $this->createDefaultShippingAddress($customer);
        }

        if ($customer->getDefaultBilling() === null) {
            $this->createDefaultBillingAddress($customer);
        }

        return $this->addressRepository->getById($id);
    }

    /**
     * @param $customer
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function createDefaultShippingAddress($customer): void
    {
        $region = $this->regionFactory->create();
        $region->setRegionCode('10019')
            ->setRegion('Hudson')
            ->setRegionId(35);
        $address = $this->addressDataFactory->create();
        $address->setCustomerId($customer->getId())
            ->setFirstname($customer->getFirstname())
            ->setLastname($customer->getLastname())
            ->setCity('New York')
            ->setCountryId('US')
            ->setRegion($region)
            ->setStreet(['Commerce St'])
            ->setPostcode('10532')
            ->setTelephone(123123123)
            ->setPostcode(12546)
            ->setIsDefaultShipping(true);
        $this->addressRepository->save($address);
    }

    /**
     * @param $customer
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function createDefaultBillingAddress($customer): void
    {
        $region = $this->regionFactory->create();
        $region->setRegionCode('10019')
            ->setRegion('Hudson')
            ->setRegionId(35);
        $address = $this->addressDataFactory->create();
        $address->setCustomerId($customer->getId())
            ->setFirstname($customer->getFirstname())
            ->setLastname($customer->getLastname())
            ->setCity('Las Vegas')
            ->setCountryId('US')
            ->setRegion($region)
            ->setStreet(['Vegas St'])
            ->setPostcode('10532')
            ->setTelephone(1225151)
            ->setPostcode(987654)
            ->setIsDefaultBilling(true);
        $this->addressRepository->save($address);
    }
}
