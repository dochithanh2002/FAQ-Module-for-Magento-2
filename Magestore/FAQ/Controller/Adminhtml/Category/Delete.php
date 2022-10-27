<?php

namespace Magestore\FAQ\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magestore\FAQ\Model\CategoryFactory;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;

class Delete extends Action implements HttpPostActionInterface
{
    protected $resultPageFactory;
    protected $categoryFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CategoryFactory $categoryFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->categoryFactory = $categoryFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        try {
            $id = $this->getRequest()->getParam('category_id');
            if ($id) {
                $model = $this->categoryFactory->create();
                $model->load($id);
                if ($model->getData()) {
                    $model->delete();
                    $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
                } else {
                    $this->messageManager->addErrorMessage(__("Staff Not Found!"));
                }
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can't delete record, Please try again."));
        }
        return $resultRedirectFactory->setPath('*/*/index');
    }
}
