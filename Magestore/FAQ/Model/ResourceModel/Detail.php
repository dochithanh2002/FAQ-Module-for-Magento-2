<?php

namespace Magestore\FAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Detail extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('faqs_detail', 'faqs_id');
    }
}
