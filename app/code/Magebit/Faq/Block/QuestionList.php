<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magebit\Faq\Block;

use Magento\Framework\View\Element\AbstractBlock;

/**
 * Cms block content block
 * @deprecated This class introduces caching issues and should no longer be used
 * @see \Magebit\Faq\Block\BlockByIdentifier
 */
class QuestionList extends \Magento\Framework\View\Element\Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}
