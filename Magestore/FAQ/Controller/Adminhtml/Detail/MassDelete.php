<?php

namespace Magestore\FAQ\Controller\Adminhtml\Detail;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magestore\FAQ\Model\ResourceModel\Detail\CollectionFactory;

class MassDelete extends Action
{
    protected $_coreRegistry;
    protected $resultPageFactory;
    protected $collectionFactory;
    protected $filter;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        $checklist = $this->filter->getCollection($this->collectionFactory->create());
        $count = 0;
        foreach ($checklist as $item) {
            $item->delete();
            $count++;
            $this->messageManager->addSuccessMessage(__('ID %1 deleted.', $item['faqs_id']));
        }
        if ($count != 0) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $count));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
}
