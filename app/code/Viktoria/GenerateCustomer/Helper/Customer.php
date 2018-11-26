<?php

namespace Viktoria\GenerateCustomer\Helper;

class Customer extends \Magento\Framework\App\Helper\AbstractHelper
{
    public const KEY_FIRSTNAME = 'customer-firstname';

    public const KEY_LASTNAME = 'customer-lastname';

    public const KEY_EMAIL = 'customer-email';

    public const KEY_PASSWORD = 'customer-password';

    public const KEY_WEBSITE = 'website';

    public const KEY_SENDEMAIL = 'send-email';

    /**
     * @var \Magento\Framework\App\State $state
     */
    private $state;

    /**
     * @var \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerFactory
     */
    private $customerFactory;

    /**
     * @var \Magento\Customer\Api\GroupManagementInterface $customerGroupManagement
     */

    private $customerGroupManagement;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Magento\Customer\Api\AccountManagementInterface
     */
    private $accountManagement;

    /**
     * @var array
     */
    private $firstname = ['Olivia', 'Oliver',
        'Amelia', 'Harry', 'Isla', 'Jack', 'Emily',
        'George', 'Ava', 'Noah', 'Lily',
        'Charlie', 'Mia', 'Jacob', 'Sophia',
        'Alfie', 'Isabella', 'Freddie', 'Grace'];

    /**
     * @var array
     */
    private $lastname = ['Smith', 'Johnson', 'Williams',
        'Jones', 'Brown', 'Davis', 'Miller', 'Wilson',
        'Moore', 'Taylor', 'Anderson', 'Thomas', 'Jackson',
        'White', 'Harris', 'Martin', 'Thompson', 'Garcia', 'Martinez'];

    /**
     * @var array
     */
    private $emailDomains = ['@ukr.net', '@gmail.com',
        '@yahoo.com', '@outlook.com', '@zillum.com',
        '@icloud.com', '@mail.com'
    ];

    /**
     * Customer constructor.
     * @param \Magento\Framework\App\State $state
     * @param \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerFactory
     * @param \Magento\Customer\Api\GroupManagementInterface $customerGroupManagement
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Customer\Api\AccountManagementInterface $accountManagement
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerFactory,
        \Magento\Customer\Api\GroupManagementInterface $customerGroupManagement,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Api\AccountManagementInterface $accountManagement,
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
        $this->state = $state;
        $this->customerFactory = $customerFactory;
        $this->customerGroupManagement = $customerGroupManagement;
        $this->storeManager = $storeManager;
        $this->accountManagement = $accountManagement;
    }

    /**
     * @param int $count
     * @return \Generator|null
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Exception
     */
    public function generateCustomers(int $count): ?\Generator
    {
        $this->state->setAreaCode('frontend');

        for ($i = 0; $i < $count; $i++) {
            $firstName = $this->getRandomEl($this->firstname);
            $lastName = $this->getRandomEl($this->lastname);
            $email = strtolower("{$firstName}_$lastName") . $this->getRandomEl($this->emailDomains);

            $customerDataObject = $this->customerFactory->create();
            $customerDataObject->setFirstname($firstName)
                ->setLastname($lastName)
                ->setEmail($email);

            $store = $this->storeManager->getStore();
                $customerDataObject->setGroupId(
                    $this->customerGroupManagement->getDefaultGroup($store->getId())->getId()
                );

            $customerDataObject->setWebsiteId($store->getWebsiteId());
            $customerDataObject->setStoreId($store->getId());

            // @todo: set flag not to send emails
            // write a plugin that will wrap the method to send emails and not do this if the registry key is present
            $customer = $this->accountManagement->createAccount($customerDataObject, $email . '1', '');
            // restore sending emails
            yield $customer;
        }

        return null;
    }

    /**
     * @param $array
     * @return string
     * @throws \Exception
     */
    private function getRandomEl($array): string
    {
        return $array[random_int(0, count($array) - 1)];
    }
}
