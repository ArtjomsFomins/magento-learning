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

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Model\QuestionSearchResults;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Question CRUD interface.
 * @api
 */
interface QuestionRepositoryInterface
{
    /**
     * Get info about question by question id
     *
     * @param int $questionId
     * @return QuestionInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($questionId): QuestionInterface;

    /**
     * Save question.
     *
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\QuestionInterface $question): QuestionInterface;

    /**
     * Retrieve questions matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResults
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResults;

    /**
     * Delete question.
     *
     * @param QuestionInterface $question
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\QuestionInterface $question): bool;

    /**
     * Delete question by ID.
     *
     * @param string $questionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($questionId): bool;
}
