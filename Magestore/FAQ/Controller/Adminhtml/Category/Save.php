<?php

namespace Magestore\FAQ\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\View\Result\PageFactory;
use Magestore\FAQ\Model\CategoryFactory;

class Save extends Action
{
    protected $resultPageFactory;
    protected $categoryFactory;
    protected $formKeyValidator;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CategoryFactory $categoryFactory,
        Validator $formKeyValidator
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->categoryFactory = $categoryFactory;
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
                $data['image'] = $data['images'][0]['name'];
                $category = $this->categoryFactory->create();
                $category->setData($data)->save();

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
