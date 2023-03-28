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

namespace Magebit\Faq\Api\Data;

/**
 * Question interface.
 * @api
 */
interface QuestionInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID      = 'id';
    const IDENTIFIER    = 'identifier';
    const QUESTION         = 'question';
    const ANSWER       = 'answer';
    const STATUS = 'status';
    const POSITION   = 'position';
    const UPDATED_AT     = 'updated_at';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get question title
     *
     * @return string
     */
    public function getQuestion();


    /**
     * Get question's answer
     *
     * @return string
     */
    public function getAnswer();

    /**
     * Get question status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Get question position
     *
     * @return int
     */
    public function getPosition();

    /**
     * Get question last time modified
     *
     * @return string
     */
    public function getUpdateAt();


    /**
     * Set question title
     *
     * @param string $title
     * @return QuestionInterface
     */
    public function setQuestion($title);

    /**
     * Set question's answer
     *
     * @param string $answer
     * @return QuestionInterface
     */
    public function setAnswer($answer);

    /**
     * Set question status
     *
     * @param int $status
     * @return QuestionInterface
     */
    public function setStatus($status);

    /**
     * Set question position
     *
     * @param int $id
     * @return QuestionInterface
     */
    public function setPosition($id);
}
