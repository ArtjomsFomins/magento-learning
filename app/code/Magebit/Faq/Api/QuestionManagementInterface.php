<?php

/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Artjoms Fomins <info@magebit.com>
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

declare(strict_types=1);

namespace Magebit\Faq\Api;

/**
 * Interface for question management status
 * @api
 */
interface QuestionManagementInterface
{
    /**
     * Enable question
     *
     * @param integer $questionId
     * @return void
     */
    public function enableQuestion(int $questionId);

    /**
     * Disable question
     *
     * @param integer $questionId
     * @return void
     */
    public function disableQuestion(int $questionId);
}
