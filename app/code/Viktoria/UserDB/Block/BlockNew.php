<?php /** @noinspection ALL */

namespace Viktoria\UserDB\Block;

use Magento\Framework\View\Element\Template;

class BlockNew extends \Magento\Framework\View\Element\Template
{
    private $contactFactory;
    /**
     * BlockNew constructor.
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Viktoria\UserDB\Model\ContactFactory $contactFactory
    )
    {
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getWelcomeText()
    {
        return 'Hello World';
    }

    public function getContactCollection()
    {
        $contact = $this->contactFactory->create();
        return $contact->getCollection();
    }
}

