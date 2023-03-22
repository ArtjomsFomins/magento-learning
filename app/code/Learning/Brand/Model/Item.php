<?php
declare(strict_types=1);

namespace Learning\Brand\Model;

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
}
