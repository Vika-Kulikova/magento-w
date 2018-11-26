<?php

namespace Viktoria\UserDB\Block;

use Viktoria\UserDB\Model\ResourceModel\Contact\Collection as ContactCollection;

class Generate extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Viktoria\UserDB\Model\ResourceModel\Contact\CollectionFactory
     */
    private $contactCollectionFactory;

    /**
     * GenerateBlock constructor.
     * @param \Viktoria\UserDB\Model\ResourceModel\Contact\CollectionFactory $contactCollectionFactory
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Viktoria\UserDB\Model\ResourceModel\Contact\CollectionFactory $contactCollectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        $data = []
    ) {
        parent::__construct($context, $data);
        $this->contactCollectionFactory = $contactCollectionFactory;
    }

    /**
     * @return ContactCollection
     */
    public function getContactCollection(): ContactCollection
    {
        return $this->contactCollectionFactory->create();
    }

    /**
     * @return string
     */
    public function getPostActionUrl(): string
    {
        return $this->getUrl('user_db/test/generate');
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
     * @param $count
     * @return array
     */
    private function generateCustomers($count): array
    {
        for ($i = 0; $i < $count; $i++) {
            $name = $this->getRandomEl($this->getContactCollection()->getName());
            $surname = $this->getRandomEl($this->getContactCollection()->getSurname());
            $email = strtolower("{$name}_$surname") . $this->getRandomEl($this->emailDomains);

            $this->getContactCollection()->setName($name);
            $this->getContactCollection()->setSurname($surname);
            $this->getContactCollection()->setEmail($email);
        }
    }
}
