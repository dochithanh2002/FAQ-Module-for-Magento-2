<?php

namespace Magestore\FAQ\Block\Adminhtml\Category\Button;

use Magento\Backend\Block\Widget\Context;

class Generic
{

    protected $context;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

}
