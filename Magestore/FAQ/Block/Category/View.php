<?php

namespace Magestore\FAQ\Block\Category;

use Magento\Framework\View\Element\Template;
use Magestore\FAQ\Model\ResourceModel\Detail\CollectionFactory;

class View extends \Magento\Framework\View\Element\Template
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

    public function getDetail()
    {
        $value = $this->request->getParam('category_id');
        $detailCollection = $this->collectionFactory->create();
        $detailCollection->addFieldToSelect('*');
        $detailCollection->addFieldToFilter('category_id', $value);
        $detailCollection->addFieldToFilter('status', 1);

        return  $detailCollection->getData();
    }

    public function getCategoryID()
    {
        $value = $this->request->getParam('category_id');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('faq_category');
        $sql = "SELECT * FROM " . $tableName . " WHERE category_id = " . $value;
        return $connection->fetchAll($sql);
    }
}
