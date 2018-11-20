<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 05.11.18
 * Time: 11:32
 */

namespace Viktoria\UserGeneration\Block;

use Magento\Framework\View\Element\Template;


class Contactslist extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Template\Context
     * @var array
     */
    private $context;
    private $data;

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->setData('contacts',[]);
        $this->context = $context;
        $this->data = $data;
    }

    public function addContacts($count)
    {
        $_contacts = $this->getData('contacts');
        $actualNumber = count($_contacts);
        $names = [];
        for($i=$actualNumber;$i<($actualNumber+$count);$i++) {
            $_contacts[] = 'nom '.($i+1);
        }
        $this->setData('contacts',$_contacts);
    }
}