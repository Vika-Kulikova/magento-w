<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 24.10.18
 * Time: 14:20
 */

namespace Viktoria\AddCustomer\Block;


class HelloWorld extends \Magento\Framework\View\Element\Template
{
    public function getWelcomeText()
    {
        return 'Hello World';
//        \Magento\Framework\Registry $registry
    }
}