<?php
declare(strict_types=1);

namespace Learning\Brand\Model;

use Learning\Brand\Model\ResourceModel\Item as ResourceModelItem;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;

class Item extends AbstractModel
{
    protected $_eventPrefix = 'learning_sample_item';

    public function __construct(
        Context          $context,
        Registry         $registry,
        AbstractResource $resource = null,
        AbstractDb       $resourceCollection = null,
        array            $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize customer model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(ResourceModelItem::class);
    }
}
