<?php
/**
 * Created by PhpStorm.
 * User: viktoriiak
 * Date: 02.11.18
 * Time: 12:47
 */

namespace Viktoria\UserGeneration\Model;

use Magento\Cron\Exception;
use Magento\Framework\Model\AbstractModel;

class Contact extends AbstractModel
{
    protected $dateTime;

    /**
     * @return void
     */

    protected function _construct()
    {
        $this->_init(\Viktoria\UserGeneration\Model\ResourceModel\Contact::class);
    }
}