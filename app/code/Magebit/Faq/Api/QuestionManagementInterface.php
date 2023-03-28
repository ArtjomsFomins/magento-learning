<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magebit\Faq\Api;

/**
 * @api
 * @since 100.0.2
 */
interface QuestionManagementInterface
{
    public function enableQuestion(int $questionId);

    public function disableQuestion(int $questionId);
}
