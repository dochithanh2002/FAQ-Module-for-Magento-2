<?php

namespace Magestore\FAQ\Model\ResourceModel\Detail;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestore\FAQ\Model\ResourceModel\Detail as DetailResourceModel;
use Magestore\FAQ\Model\Detail as DetailModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(DetailModel::class, DetailResourceModel::class);
    }
}
