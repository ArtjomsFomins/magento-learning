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

namespace Magebit\Faq\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

/**
 * @inheritDoc
 */
class Index extends \Magento\Backend\App\Action
{
    private PageFactory $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $rawFactory
    ) {
        $this->pageFactory = $rawFactory;

        parent::__construct($context);
    }

    /**
     * @inheritDoc
     *
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create(ResultFactory::TYPE_PAGE);
    }
}