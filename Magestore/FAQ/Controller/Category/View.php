<?php

namespace Magestore\FAQ\Controller\Category;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class View extends Action
{
    protected $resultPageFactory;
    protected $_urlRewriteFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_urlRewriteFactory = $urlRewriteFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('FAQ category2'));
        $resultPage->getConfig()->getTitle()->prepend(__("View Staff"));
//
//        $urlRewriteModel = $this->_urlRewriteFactory->create();
//        /* set current store id */
//        $urlRewriteModel->setStoreId(1);
//        /* this url is not created by system so set as 0 */
//        $urlRewriteModel->setIsSystem(0);
//        /* unique identifier - set random unique value to id path */
//        $urlRewriteModel->setIdPath(rand(1, 100000));
//        /* set actual url path to target path field */
//        $urlRewriteModel->setTargetPath("faq/category/view/category_id/2");
//        /* set requested path which you want to create */
//        $urlRewriteModel->setRequestPath("account.html");
//        /* set current store id */
//        $urlRewriteModel->save();
        return $resultPage;
    }
}
