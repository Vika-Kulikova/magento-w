<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 02.11.18
 * Time: 12:53
 */

namespace Viktoria\UserGeneration\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Contact
 * @package Viktoria\UserGeneration\ResourceModel
 */

class Contact extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('new_contact', 'new_contact_id');

    }
}

