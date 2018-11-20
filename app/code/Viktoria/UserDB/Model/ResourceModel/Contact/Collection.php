<?php

namespace Viktoria\UserDB\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        parent::_construct();
        $this->_init(\Viktoria\UserDB\Model\Contact::class, \Viktoria\UserDB\Model\ResourceModel\Contact::class);
    }
}
