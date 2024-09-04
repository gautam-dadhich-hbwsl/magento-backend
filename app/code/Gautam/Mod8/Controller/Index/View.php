<?php
namespace Gautam\Mod8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Gautam\Mod8\Model\ResourceModel\Employee\CollectionFactory;

class View extends Action
{
    protected $resultPageFactory;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        
        // Set the collection data to the block
        $block = $resultPage->getLayout()->getBlock('employee_table');
        if ($block) {
            $block->setCollection($this->collectionFactory->create());
        }

        return $resultPage;
    }
}
    