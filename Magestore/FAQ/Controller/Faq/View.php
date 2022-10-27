<?php

namespace Magestore\FAQ\Controller\Faq;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
class View extends Action
{

    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
//        $id = $this->getRequest()->getParam('category_id');
//        if(!empty($id)){
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('FAQ View'));
        $resultPage->getConfig()->getTitle()->prepend(__("Faq View"));
        return $resultPage;
        //       }
    }

}
