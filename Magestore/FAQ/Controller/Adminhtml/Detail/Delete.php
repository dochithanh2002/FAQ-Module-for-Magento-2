<?php

namespace Magestore\FAQ\Controller\Adminhtml\Detail;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magestore\FAQ\Model\DetailFactory;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;

class Delete extends Action implements HttpPostActionInterface
{
    protected $resultPageFactory;
    protected $detailFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DetailFactory $detailFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->detailFactory = $detailFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        try {
            $id = $this->getRequest()->getParam('faqs_id');
            if ($id) {
                $model = $this->detailFactory->create();
                $model->load($id);
                if ($model->getData()) {
                    $model->delete();
                    $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
                } else {
                    $this->messageManager->addErrorMessage(__("Question Not Found!"));
                }
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can't delete record, Please try again."));
        }
        return $resultRedirectFactory->setPath('*/*/index');
    }
}
