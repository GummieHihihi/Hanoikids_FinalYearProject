<?php
namespace Hanoikids\Homepage\Block\Widget;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class FavouriteProduct extends Template implements BlockInterface
{
    protected $_template = "widget/FavouriteProduct.phtml";
    protected $_productCollectionFactory;
    protected $_categoryCollectionFactory;
    protected $categoryFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->categoryFactory = $categoryFactory;
        parent::__construct($context);
    }

    public function getCategoryID($categoryTitle)
    {
        $collection = $this->_categoryCollectionFactory->create()->addAttributeToFilter('name', $categoryTitle);
        if ($collection->getSize()) {
            return $categoryId = $collection->getFirstItem()->getId();
        } else {
            return null;
        }

    }

    public function getCategoryData()
    {
        $collection = $this->_productCollectionFactory->create()->getData();
        $id = $this->getCategoryID($this->getData('category'));
        if ($id) {
            $category = $this->categoryFactory->create()->load($id);
            $product = $category->getProductCollection()->addAttributeToSelect('*');
            $product->addAttributeToSelect('*');
            $product->setPageSize(3); // fetching only 3 products
            // die('123');
            return $product;
        }
        return " nothing to be displayed";
    }

}
