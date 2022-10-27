<?php

namespace Magestore\FAQ\Model\Source;

use Magestore\FAQ\Model\ResourceModel\Category\CollectionFactory;

class Category implements \Magento\Framework\Option\ArrayInterface
{
    protected $collectionFactory;

    public function __construct(  CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $options[] = ['label' => '-- Please Select --', 'value' => ''];
//        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
//        $connection = $resource->getConnection();
//        $tableName = $resource->getTableName('faq_category');
//        $sql = "Select * FROM " . $tableName;
//        $collection = $connection->fetchAll($sql);

        $categoryCollection = $this->collectionFactory->create();
        $categoryCollection->addFieldToSelect('*');
        foreach ($categoryCollection as $category) {
            $options[] = [
                'label' => $category['name'],
                'value' => $category['category_id'],
            ];
        }

        return $options;
    }
}
