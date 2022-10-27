<?php

namespace Magestore\FAQ\Model\ResourceModel;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Category extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('faq_category', 'category_id');
    }
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $image = $object->getData('image');
        $images = $object->getData('images');

        if ($image !=null && !empty($images[0]['tmp_name'])) {
            /** @var \Magestore\FAQ\CategoryImageUpload $imageUploader */
            $imageUploader = ObjectManager::getInstance()->get('Magestore\FAQ\CategoryImageUpload');

            $imageUploader->moveFileFromTmp($image);
        }
        return $this;
    }
}
