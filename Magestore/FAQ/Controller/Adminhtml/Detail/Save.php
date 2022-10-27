<?php

namespace Magestore\FAQ\Controller\Adminhtml\Detail;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\View\Result\PageFactory;
use Magestore\FAQ\Model\DetailFactory;

class Save extends Action
{
    protected $resultPageFactory;
    protected $detailFactory;
    protected $formKeyValidator;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DetailFactory $detailFactory,
        Validator $formKeyValidator
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->detailFactory = $detailFactory;
        $this->formKeyValidator = $formKeyValidator;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPageFactory = $this->resultRedirectFactory->create();
        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(__("Form key is Invalidate"));
            return $resultPageFactory->setPath('*/*/index');
        }
        $data = $this->getRequest()->getPostValue();
        try {
            if ($data) {
                $detail = $this->detailFactory->create();
                $detail->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
                $buttondata = $this->getRequest()->getParam('back');
                if ($buttondata == 'add') {
                    return $resultPageFactory->setPath('*/*/form');
                }
                if ($buttondata == 'close') {
                    return $resultPageFactory->setPath('*/*/index');
                }
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can't submit your request, Please try again."));
        }
        return $resultPageFactory->setPath('*/*/index');
    }
}
