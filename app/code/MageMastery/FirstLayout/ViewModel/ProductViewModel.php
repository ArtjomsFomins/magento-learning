<?php

namespace MageMastery\FirstLayout\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Model\ResourceTest;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductViewModel implements ArgumentInterface
{

    public function getProductBySku(string $sku): string
    {
        return '33333';
    }
}


?>
