<?php

namespace Magestore\FAQ\Block\Adminhtml\Detail\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends Generic implements ButtonProviderInterface
{
    protected $context;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    public function getButtonData()
    {
        $data = [];
        $id = $this->context->getRequest()->getParam('faqs_id');
        if ($id) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to delete this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\', {data: {}} )',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    public function getDeleteUrl()
    {
        $id = $this->context->getRequest()->getParam('faqs_id');
        return $this->getUrl('*/*/delete', ['faqs_id' => $id]);
    }
}
