<?php
declare(strict_types=1);

namespace Learning\Brand\Model\ResourceModel\Item;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\Brand\Model\Item;
use Learning\Brand\Model\ResourceModel\Item as ItemResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Item::class, ItemResourceModel::class);
    }
}
