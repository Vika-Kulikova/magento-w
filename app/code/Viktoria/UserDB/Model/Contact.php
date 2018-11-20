<?php

namespace Viktoria\UserDB\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Contact
 * @method string getName()
 * @method Contact setName(string $name)
 * @method Contact setEmail(string $email)
 * @method Contact setComment(string $comment)
 */
class Contact extends AbstractModel
{
    public function _construct()
    {
        $this->_init(\Viktoria\UserDB\Model\ResourceModel\Contact::class);
    }
}
