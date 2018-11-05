<?php

namespace Viktoria\CheckPageLink\Block;

use Magento\Framework\Exception\LocalizedException;
use Viktoria\CheckPageLink\Observer\CmsPageRender;

/**
 * Class CheckPageId
 * @package Viktoria\CheckPageLink\Block
 *
 * @method int getPageId()
 */
class CheckPageId extends \Magento\Cms\Block\Widget\Page\Link
{
    private $registry;

    /**
     * CheckPageId constructor.
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Cms\Model\ResourceModel\Page $resourcePage
     * @param \Magento\Cms\Helper\Page $cmsPage
     * @param array $data
     * @throws LocalizedException
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Model\ResourceModel\Page $resourcePage,
        \Magento\Cms\Helper\Page $cmsPage,
        array $data = []
    ) {
        if (!isset($data['page_id'])) {
            throw new LocalizedException(__('Page ID is not set'));
        }

        parent::__construct($context, $resourcePage, $cmsPage, $data);
        $this->registry = $registry;
    }

    /**
     * @return string
     */
    public function getLinkAttributes(): string
    {
        $attributes = [];
        foreach ($this->allowedAttributes as $attribute) {
            $value = $this->getDataUsingMethod($attribute);
            if ($value !== null) {
                $attributes[$attribute] = $this->escapeHtml($value);
            }
        }

        if ($this->isCurrentPage()) {
            if (!isset($attributes['class'])) {
                $attributes['class'] = 'current';
            } else {
                $attributes['class'] .= ' current';
            }
        }

        if (!empty($attributes)) {
            return $this->serialize($attributes);
        }

        return '';
    }

    /**
     * CmsPageRender constructor.
     * @return bool
     */
    public function isCurrentPage(): bool
    {
        return $this->registry->registry(CmsPageRender::CURRENT_CMS_PAGE_ID) === (int) $this->getPageId();
    }
}
