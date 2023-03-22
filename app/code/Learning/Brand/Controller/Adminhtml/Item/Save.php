<?php

namespace Learning\Brand\Controller\Adminhtml\Item;

use Magento\Framework\App\Action\HttpPostActionInterface;

use Learning\Brand\Model\ItemFactory;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    protected \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor;
    private \Magento\Customer\Api\Data\GroupExtensionInterfaceFactory $groupExtensionInterfaceFactory;
    protected ItemFactory $itemFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ItemFactory $itemFactory
    ) {
        parent::__construct($context);
        $this->itemFactory = $itemFactory;
    }

    /**
     * Create or save customer group.
     *
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $this->itemFactory->create()->setData($this->getRequest()->getPostValue()['general'])->save();

        return $this->resultRedirectFactory->create()->setPath('learning_brand/brand/index');
    }
}
