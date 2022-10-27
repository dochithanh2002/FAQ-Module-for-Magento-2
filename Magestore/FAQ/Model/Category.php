<?php

namespace Magestore\FAQ\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magestore\FAQ\Model\ResourceModel\Category as CategoryResourceModel;

class Category extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'faq_category';
    public function _construct()
    {
        $this->_init(CategoryResourceModel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
