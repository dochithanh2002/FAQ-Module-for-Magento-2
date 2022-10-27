<?php

namespace Magestore\FAQ\Block\Search;

use Magento\Framework\View\Element\Template;
use Magestore\FAQ\Model\ResourceModel\Detail\CollectionFactory;

class SearchForm extends \Magento\Framework\View\Element\Template
{
    protected $collectionFactory;
    protected $request;
    public function __construct(
        CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        Template\Context $context,
        array $data = []
    ) {
        $this->request = $request;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getDetail()
    {
        $value = $this->request->getParam('s');
        $detailCollection = $this->collectionFactory->create();

//        $detailCollection->addFieldToSelect('*');
//        $detailCollection->addFieldToFilter('faqs_question', [
//            ['like' => '%' . $value . '%'],
//            ['like' => '%' . $value],
//            ['like' => $value . '%'],
//            ['like' => $value]
//        ]);//        $detailCollection->addFieldToFilter('status', 1);
////        return  $detailCollection->getData();

        $connection = $detailCollection->getConnection();
        $sql = "SELECT * FROM `faqs_detail`
                    WHERE `faqs_question` LIKE '%" . $value . "%'
                    OR `faqs_question` LIKE '%" . $value . "'
                    OR `faqs_question` LIKE '" . $value . "%'
                    OR `faqs_question` LIKE '" . $value . "'
                    AND status = 1;";

        return $connection->fetchAll($sql);
    }
}
