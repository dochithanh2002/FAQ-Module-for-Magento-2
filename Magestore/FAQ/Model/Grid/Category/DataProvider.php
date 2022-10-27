<?php

namespace Magestore\FAQ\Model\Grid\Category;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magestore\FAQ\Model\ResourceModel\Category\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData;
    protected $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []

    ) {
        $this->storeManager = $storeManager;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (! $this->loadedData) {
            $items = $this->collection->getItems();
            foreach ($items as $model) {
                $data = $model->getData();
                $image = $data['image'];

                $data['images'][0]['url'] = $this->storeManager->getStore()->getBaseUrl(
                    UrlInterface::URL_TYPE_MEDIA
                    ) . 'category/images/' . $image;
                $data['images'][0]['name'] = $image;
                $this->loadedData[$model->getId()] = $data;
            }
        }
        return $this->loadedData;
    }
}
