<?php

namespace Viktoria\UserDB\Controller\Test;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Viktoria\UserDB\Model\ContactFactory $contactFactory
     */
//    private $contactFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Viktoria\UserDB\Model\ContactFactory $contactFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context
//        \Viktoria\UserDB\Model\ContactFactory $contactFactory
    ) {
//        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }

    public function execute()
    {
       return $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        $contact = $this->contactFactory->create();
//        $collection = $contact->getCollection();
//        foreach($collection as $item){
//            echo "<pre>";
//            print_r($item->getData());
//            echo "</pre>";
//        }
//        exit();

    }
}

