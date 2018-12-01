<?php

namespace Viktoria\GenerateCustomer\Plugin;

use Magento\Customer\Model\EmailNotification;

/**
 * Class EmailNotificationPlugin
 * @package Viktoria\GenerateCustomer\Plugin
 */
class EmailNotificationPlugin
{
    /**
     * @param \Magento\Customer\Model\EmailNotificationInterface $emailNotification
     * @param callable $proceed
     * @param \Magento\Customer\Api\Data\CustomerInterface $customer
     * @param string $type
     * @param string $backUrl
     * @param int $storeId
     * @param null $sendemailStoreId
     * @return \Magento\Customer\Model\EmailNotificationInterface
     */
    public function aroundNewAccount(
        \Magento\Customer\Model\EmailNotificationInterface $emailNotification,
        callable $proceed,
        \Magento\Customer\Api\Data\CustomerInterface $customer,
        $type = \Magento\Customer\Model\EmailNotificationInterface::NEW_ACCOUNT_EMAIL_REGISTERED,
        $backUrl = '',
        $storeId = 0,
        $sendemailStoreId = null
    ) {
        if ($type === EmailNotification::NEW_ACCOUNT_EMAIL_REGISTERED
            || $type === EmailNotification::NEW_ACCOUNT_EMAIL_CONFIRMED) {
            return $emailNotification;
        }
        return $proceed($customer, $type, $backUrl, $storeId, $sendemailStoreId);
    }
}

