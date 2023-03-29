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

use Magebit\Faq\Model\Question;

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
     * @return Question
     */
    public function enableQuestion(int $questionId): Question;

    /**
     * Disable question
     *
     * @param integer $questionId
     * @return Question
     */
    public function disableQuestion(int $questionId): Question;
}
