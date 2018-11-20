<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 05.11.18
 * Time: 11:32
 */

namespace Viktoria\UserGeneration\Block;

use Magento\Framework\View\Element\Template;

class Contactslist extends Template
{
    public function __construct(\Magento\Backend\Block\Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->setData('contacts',[]);
    }

    public function addContacts($count)
    {
        $contacts = $this->getData('contacts');
        $actualNumber = count($contacts);
        $names = [];
        for($i=$actualNumber;$i<($actualNumber+$count);$i++) {
            $contacts[] = 'nom '.($i+1);
        }
        $this->setData('contacts',$contacts);
    }
}