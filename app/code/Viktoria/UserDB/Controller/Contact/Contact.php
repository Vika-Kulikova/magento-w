<?php

namespace Viktoria\UserDB\Controller\Contact;

use Viktoria\UserDB\Model\Contact as ContactModel;
use Magento\Framework\Controller\ResultFactory;

class Contact extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Viktoria\UserDB\Model\ContactFactory
     */
    private $contactFactory;

    /**
     * @var \Magento\Framework\DB\Transaction
     */
    private $transaction;

    /**
     * Contact constructor.
     * @param \Viktoria\UserDB\Model\ContactFactory $contactFactory
     * @param \Magento\Framework\DB\Transaction $transaction
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Viktoria\UserDB\Model\ContactFactory $contactFactory,
        \Magento\Framework\DB\Transaction $transaction,
        \Magento\Framework\App\Action\Context $context
    ) {
        parent::__construct($context);
        $this->contactFactory = $contactFactory;
        $this->transaction = $transaction;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        for ($count = 0; $count < 3; ++$count) {
            /** @var ContactModel $contact */
            $contact = $this->contactFactory->create();
            $contact->setName('Paul Ricard ' . uniqid('uid_', true));

            $contact->setEmail('Paul_Ricard@gmail.ru ');
            $contact->setComment('Comment from Paul');
            $this->transaction->addObject($contact);
        }

        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        try {
            $this->transaction->save();
        } catch (\Exception $e) {
            return $result->setContents($e->getMessage());
        }
        return $result->setContents('Successfully saved models!');
    }
}

