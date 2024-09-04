<?php
namespace Gautam\Mod8\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Data\Collection;

class TableData extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        \Gautam\Mod8\Model\ResourceModel\Employee\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getEmployeeData($sortColumn = 'employee_id', $sortOrder = 'ASC')
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->setOrder($sortColumn, $sortOrder);
        return $collection->getItems();
    }
}
