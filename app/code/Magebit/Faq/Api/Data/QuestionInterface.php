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

namespace Magebit\Faq\Api\Data;

/**
 * Interface for question model.
 * @api
 */
interface QuestionInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    public const ID      = 'id';
    public const IDENTIFIER    = 'identifier';
    public const QUESTION         = 'question';
    public const ANSWER       = 'answer';
    public const STATUS = 'status';
    public const POSITION   = 'position';
    public const UPDATED_AT     = 'updated_at';
    /**#@-*/

    /**
     * Get ID
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get question title
     *
     * @return string
     */
    public function getQuestion(): string;

    /**
     * Get question's answer
     *
     * @return string
     */
    public function getAnswer(): string;

    /**
     * Get question status
     *
     * @return string
     */
    public function getStatus(): string;

    /**
     * Get question position
     *
     * @return int
     */
    public function getPosition(): int;

    /**
     * Get question last time modified
     *
     * @return string
     */
    public function getUpdateAt(): string;

    /**
     * Set question title
     *
     * @param string $title
     * @return QuestionInterface
     */
    public function setQuestion($title): QuestionInterface;

    /**
     * Set question's answer
     *
     * @param string $answer
     * @return QuestionInterface
     */
    public function setAnswer($answer): QuestionInterface;

    /**
     * Set question status
     *
     * @param int $status
     * @return QuestionInterface
     */
    public function setStatus($status): QuestionInterface;

    /**
     * Set question position
     *
     * @param int $id
     * @return QuestionInterface
     */
    public function setPosition($id): QuestionInterface;
}
