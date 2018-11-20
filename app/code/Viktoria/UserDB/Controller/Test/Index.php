<?php

namespace Viktoria\UserDB\Controller\Test;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context
    ) {

        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        $resultPage->getConfig()->getTitle()->set(__('Custom Pagination'));
        return $resultPage;
    }
}

