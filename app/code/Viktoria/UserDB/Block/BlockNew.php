<?php /** @noinspection ALL */

namespace Viktoria\UserDB\Block;

class BlockNew extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Viktoria\UserDB\Model\ContactFactory
     */
    private $contactFactory;

    /**
     * BlockNew constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Viktoria\UserDB\Model\ContactFactory $contactFactory
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Viktoria\UserDB\Model\ContactFactory $contactFactory
    )
    {
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }

//    /**
//     * @return string
//     */
//    public function getWelcomeText()
//    {
//        return 'Hello World';
//    }

    /**
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getContactCollection()
    {
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5;

        $contact = $this->contactFactory->create()->getCollection();
        $contact->setPageSize($pageSize);
        $contact->setCurPage($page);

        return $contact;
    }

    /**
     * @return $this|Template
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Customers'));

        if ($this->getContactCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'viktoria.customer.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)
                ->setCollection($this->getContactCollection()
            );
            $this->setChild('pager', $pager);
            $this->getContactCollection()->load();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}

