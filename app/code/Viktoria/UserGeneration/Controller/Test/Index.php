<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 05.11.18
 * Time: 10:39
 */

namespace Viktoria\UserGeneration\Controller\Test;


class Index extends \Magento\Framework\App\Action\Action
{
//    /**
//     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
//     */
////    public function execute()
////    {
////        $contact = $this->_objectManager->create('Viktoria\UserGeneration\Model\Contact');
////        $contact->setName('Paul Dupond');
////        $contact->save();
////
////        $contact = $this->_objectManager->create('Viktoria\UserGeneration\Model\Contact');
////        $contact->setName('Jack Daniels');
////        $contact->save();
////
////        $contact = $this->_objectManager->create('Viktoria\UserGeneration\Model\Contact');
////        $contact->setName('Paul Ricard');
////        $contact->save();
////
////        die('test');
////    }
//
//    public function execute()
//    {
//        $contactModel = $this->_objectManager->create('Viktoria\UserGeneration\Model\Contact');
//        $collection = $contactModel->getCollection()->addFieldToFilter('name',
//            array('like'=> 'Paul Ricard'));
//        foreach($collection as $contact) {
//            var_dump($contact->getData());
//        }
//        die('test');
////
////        $this->_view->loadLayout();
////        $this->_view->renderLayout();
//    }

//    protected $resultPageFactory;
//
//    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
//    {
//        $this->_resultPageFactory = $resultPageFactory;
//        parent::__construct($context);
//    }
//
//    public function execute()
//    {
//        $resultPage = $this->resultPageFactory->create();
//        return $resultPage;
//    }

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}