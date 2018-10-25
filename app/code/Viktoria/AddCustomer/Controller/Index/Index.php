<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Viktoria\AddCustomer\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

//class Index extends \Magento\Contact\Controller\Index
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Layout $result */
        return  $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        $this->_view->loadLayout();
//        $this->_view->renderLayout();
    }
}
