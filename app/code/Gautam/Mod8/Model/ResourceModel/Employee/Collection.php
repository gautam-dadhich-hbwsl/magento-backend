<?php
namespace Gautam\Mod8\Model\ResourceModel\Employee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Gautam\Mod8\Model\Employee', 'Gautam\Mod8\Model\ResourceModel\Employee');
    }
}
