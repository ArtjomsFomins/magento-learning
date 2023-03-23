<?php

/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Artjoms Fomins <info@magebit.com>
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

declare(strict_types = 1);

namespace Magebit\Faq\Model\Question;

use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * @inheritDoc
 */
class DataProvider extends AbstractDataProvider
{
    protected $collection;
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
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        // $this->collection = $collectionFactory->create();
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [];
        // $result = [];
    }
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        return null;
    }
}
