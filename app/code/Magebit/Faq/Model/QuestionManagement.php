<?php

/**
 * Magebit_Faq
 *
 * @category     Magebit
 * @package      Magebit_Faq
 * @author       Artjoms Fomins <info@magebit.com>
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data;
use Magebit\Faq\Api\QuestionManagementInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as ResourceQuestion;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Reflection\DataObjectProcessor;

class QuestionManagement implements QuestionManagementInterface
{
    protected ResourceQuestion $resource;
    protected QuestionFactory $questionFactory;
    protected QuestionCollectionFactory $questionCollectionFactory;
    protected Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory;
    protected DataObjectHelper $dataObjectHelper;
    protected DataObjectProcessor $dataObjectProcessor;
    protected \Magebit\Faq\Api\Data\QuestionInterfaceFactory $dataQuestionFactory;
    protected CollectionProcessorInterface $collectionProcessor;
    protected QuestionRepositoryInterface $questionRepository;

    /**
     * @param ResourceQuestion $resource
     * @param QuestionFactory $questionFactory
     * @param Data\QuestionInterfaceFactory $dataQuestionFactory
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param QuestionRepositoryInterface $questionRepository
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        ResourceQuestion $resource,
        QuestionFactory $questionFactory,
        \Magebit\Faq\Api\Data\QuestionInterfaceFactory $dataQuestionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataQuestionFactory = $dataQuestionFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @inheritDoc
     *
     * @param integer $questionId
     * @return Question
     */
    public function enableQuestion(int $questionId): Question
    {
        $question = $this->questionRepository->get($questionId);
        if ((int)$question->getStatus() === 0) {
            $question->setStatus(1);
            $this->questionRepository->save($question);
        }
        return $question;
    }

    /**
     * @inheritDoc
     *
     * @param integer $questionId
     * @return Question
     */
    public function disableQuestion(int $questionId): Question
    {
        $question = $this->questionRepository->get($questionId);
        if ((int)$question->getStatus() === 1) {
            $question->setStatus(0);
            $this->questionRepository->save($question);
        }
        return $question;
    }
}
