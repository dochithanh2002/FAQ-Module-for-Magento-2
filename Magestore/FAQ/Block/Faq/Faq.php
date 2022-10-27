<?php

namespace Magestore\FAQ\Block\Faq;

use Magento\Framework\View\Element\Template;
use Magestore\FAQ\Model\ResourceModel\Category\CollectionFactory;

class Faq extends \Magento\Framework\View\Element\Template
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
        $detailCollection = $this->collectionFactory->create();
        $detailCollection->addFieldToSelect('*');
        $detailCollection->addFieldToFilter('status', 1);
        return  $detailCollection->getData();
    }
}
