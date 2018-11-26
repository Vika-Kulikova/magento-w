<?php

namespace Viktoria\UserDB\Controller\Test;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
//        $data = $this->getRequest()->getPost();
//        $model->setData($data);
//        $model->setName($data['name']);
//
//
//        $name = $this->getRequest()->getPostValue("name");

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
