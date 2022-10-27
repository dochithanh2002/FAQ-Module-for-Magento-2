<?php

namespace Magestore\FAQ\Model\Grid\Detail;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magestore\FAQ\Model\ResourceModel\Detail\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (! $this->loadedData) {
            $items = $this->collection->getItems();
            foreach ($items as $model) {
                $this->loadedData[$model->getId()] = $model->getData();
            }
        }
        return $this->loadedData;
    }
}
