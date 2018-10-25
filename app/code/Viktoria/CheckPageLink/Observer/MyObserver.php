<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 24.10.18
 * Time: 17:51
 */

namespace Viktoria\CheckPageLink\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class MyObserver implements ObserverInterface

{
    protected $link;

//    public function __construct(\Psr\Log\LoggerInterface $loggerInterface)
//    {
//
//        $this->logger = $loggerInterface;
//
//    }

    public function execute(Observer $observer)
    {
        $customer = $observer->getCustomer();
        $this->logger->debug($customer->getName());

    }
}