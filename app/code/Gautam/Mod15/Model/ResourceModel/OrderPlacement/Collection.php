<?php
namespace Gautam\Mod15\Model\ResourceModel\OrderPlacement;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Gautam\Mod15\Model\OrderPlacement as Model;
use Gautam\Mod15\Model\ResourceModel\OrderPlacement as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}