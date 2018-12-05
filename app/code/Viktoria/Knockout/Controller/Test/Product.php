<?php

namespace Viktoria\Knockout\Controller\Test;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Helper\Image;
use Magento\Store\Model\StoreManager;

class Product extends \Magento\Framework\App\Action\Action
{
    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @var Image
     */
    private $imageHelper;

    /**
     * @var $listProduct
     */
    private $listProduct;

    /**
     * @var StoreManager
     */
    private $storeManager;

    /**
     * Product constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param ProductFactory $productFactory
     * @param StoreManager $storeManager
     * @param Image $imageHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        ProductFactory $productFactory,
        StoreManager $storeManager,
        Image $imageHelper
    ) {
        $this->productFactory = $productFactory;
        $this->imageHelper = $imageHelper;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->productFactory->create()
            ->getCollection()
            ->addAttributeToSelect('*')
            ->setPageSize(5)
            ->setCurPage(1);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $product = $this->productFactory->create()->load($id);
            $productData = [
                'entity_id' => $product->getId(),
                'name' => $product->getName(),
                'price' => '$' . $product->getPrice(),
                'src' => $this->imageHelper->init($product, 'product_base_image')->getUrl(),
            ];

            echo json_encode($productData);
            return;
        }
    }
}
