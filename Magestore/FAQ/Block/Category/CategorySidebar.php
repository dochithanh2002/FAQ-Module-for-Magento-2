<?php

namespace Magestore\FAQ\Block\Category;

use Magento\Framework\View\Element\Template;
use Magestore\FAQ\Model\ResourceModel\Category\CollectionFactory;

class CategorySidebar extends \Magento\Framework\View\Element\Template
{
    protected $collectionFactory;
    protected $request;
    public function __construct(
        CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        Template\Context $context,
        array $data = []
    ) {
        $this->request = $request;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }


    public function getAllCategory()
    {
        $categoryCollection = $this->collectionFactory->create();
        $categoryCollection->addFieldToFilter('main_table.status', 1);
        $categoryCollection->filterCategory();

        return $categoryCollection;
    }
}

