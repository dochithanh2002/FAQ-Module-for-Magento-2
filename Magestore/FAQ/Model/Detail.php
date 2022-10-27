<?php

namespace Magestore\FAQ\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magestore\FAQ\Model\ResourceModel\Detail as DetailResourceModel;

class Detail extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'faqs_detail';
    public function _construct()
    {
        $this->_init(DetailResourceModel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
