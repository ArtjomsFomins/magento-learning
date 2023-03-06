<?php

namespace MageMastery\FirstLayout\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Model\ResourceTest;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductViewModel implements ArgumentInterface
{
    // private $resource;

    // public function __construct(ResourceTest $resource)
    // {
    //     $this->resource = $resource;
    // }

    public function getProductBySku(string $sku)
    {

        // return $this->resource->load($sku, 'sku');
        return '33333';
    }
}


?>
