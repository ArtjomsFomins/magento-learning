<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq\Model;

use Magebit\Faq\Api\CustomerManagementInterface;
use Magebit\Faq\Model\ResourceModel\Customer\CollectionFactory;

class QuestionManagement
{
    /**
     * @var CollectionFactory
     */
    protected $customersFactory;

    /**
     * @param CollectionFactory $customersFactory
     */
    public function __construct()
    {
        // $this->customersFactory = $customersFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        $customers = $this->customersFactory->create();
        /** @var \Magebit\Faq\Model\ResourceModel\Customer\Collection $customers */
        return $customers->getSize();
    }
}
