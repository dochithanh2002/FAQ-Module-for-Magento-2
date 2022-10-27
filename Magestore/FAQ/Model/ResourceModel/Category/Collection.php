<?php

namespace Magestore\FAQ\Model\ResourceModel\Category;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestore\FAQ\Model\Category as CategoryModel;
use Magestore\FAQ\Model\ResourceModel\Category as CategoryResourceModel;

class Collection extends AbstractCollection
{
    protected $resourceConnection;
    protected function _construct()
    {
        $this->_init(CategoryModel::class, CategoryResourceModel::class);
    }

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    public function filterCategory()
    {
        $this->getSelect()->joinLeft(
            ['faqs_detail' => 'faqs_detail'],
            'main_table.category_id = faqs_detail.category_id',
            []
        )->columns(
            [
                'number' => 'count(faqs_detail.faqs_id)'
            ]
        )->group('main_table.category_id');
        return $this;

    }
}
