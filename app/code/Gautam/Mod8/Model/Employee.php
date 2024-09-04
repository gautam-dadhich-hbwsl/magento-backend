<?php
namespace Gautam\Mod8\Model;

use Magento\Framework\Model\AbstractModel;
use Gautam\Mod8\Model\ResourceModel\Employee as ResourceModel;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
    