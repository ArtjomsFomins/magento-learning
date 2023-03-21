<?php
namespace Learning\Brand\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [];
    }
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        return null;
    }
}
