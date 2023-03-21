<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Learning\Brand\Controller\Adminhtml\Item;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Framework\Controller\ResultFactory;

class NewAction extends \Magento\Customer\Controller\Adminhtml\Group implements HttpGetActionInterface
{
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        return $resultPage;
    }
}
