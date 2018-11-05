<?php

namespace Viktoria\CheckPageLink\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Cms\Model\Page;

class CmsPageRender implements ObserverInterface
{
    const CURRENT_CMS_PAGE_ID = 'current_cms_page_id';

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * CmsPageRender constructor.
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(\Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
    }

    public function execute(Observer $observer)
    {
        /** @var Page $page */
        $page = $observer->getEvent()->getData('page');
        $this->registry->register(self::CURRENT_CMS_PAGE_ID, (int) $page->getId());
    }
}
