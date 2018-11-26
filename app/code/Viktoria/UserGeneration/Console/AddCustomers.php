<?php

namespace Viktoria\UserGeneration\Console;


class AddCustomers extends \Magento\Customer\Controller\AbstractAccount
{

    public function execute()
    {
        $customer = $this->customerExtractor->extract('customer_account_create', $this->_request);
        $customer->setAddresses($addresses);

        $password = $this->getRequest()->getParam('password');
        $confirmation = $this->getRequest()->getParam('password_confirmation');
        $redirectUrl = $this->session->getBeforeAuthUrl();

        $this->checkPasswordConfirmation($password, $confirmation);

        $customer = $this->accountManagement
            ->createAccount($customer, $password, $redirectUrl);
    }
}