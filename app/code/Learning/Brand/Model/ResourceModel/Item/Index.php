<?php
namespace Learning\Brand\Model\ResourceModel\Item;

class Index extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('table_name', 'entity_id');
    }
}
