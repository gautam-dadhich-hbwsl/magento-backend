<?php
namespace Gautam\Mod8\Block;

use Magento\Framework\View\Element\Template;
use Gautam\Mod8\Model\ResourceModel\Employee\CollectionFactory;

class TableData extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getEmployeeData()
    {
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }
}
