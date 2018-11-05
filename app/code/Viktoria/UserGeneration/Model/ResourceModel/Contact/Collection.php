<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 05.11.18
 * Time: 10:36
 */

namespace Viktoria\UserGeneration\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init('Viktoria\UserGeneration\Model\Contact', 'Viktoria\UserGeneration\Model\ResourceModel\Contact');
    }
}