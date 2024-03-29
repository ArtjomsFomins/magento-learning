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

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as ResourceQuestion;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\EntityManager\HydratorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Default Question repo impl.
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class QuestionRepository implements QuestionRepositoryInterface
{
    protected ResourceQuestion $resource;
    protected QuestionFactory $questionFactory;
    protected QuestionCollectionFactory $questionCollectionFactory;
    protected Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory;
    protected DataObjectHelper $dataObjectHelper;
    protected DataObjectProcessor $dataObjectProcessor;
    protected \Magebit\Faq\Api\Data\QuestionInterfaceFactory $dataQuestionFactory;
    private \Magento\Store\Model\StoreManagerInterface $storeManager;
    private CollectionProcessorInterface $collectionProcessor;
    private HydratorInterface $hydrator;

    /**
     * @param ResourceQuestion $resource
     * @param QuestionFactory $questionFactory
     * @param Data\QuestionInterfaceFactory $dataQuestionFactory
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param Data\QuestionSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param HydratorInterface|null $hydrator
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
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        ?HydratorInterface $hydrator = null
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataQuestionFactory = $dataQuestionFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->hydrator = $hydrator ?? ObjectManager::getInstance()->get(HydratorInterface::class);
    }

    /**
     * Get question
     *
     * @param ?string $questionId
     * @return Question
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(?string $questionId): QuestionInterface
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('The question with the "%1" ID doesn\'t exist.', $questionId));
        }
        return $question;
    }

    /**
     * Save question data
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return Question
     * @throws CouldNotSaveException
     */
    public function save(Data\QuestionInterface $question): Question
    {
        if (empty($question->getStoreId())) {
            $question->setStoreId($this->storeManager->getStore()->getId());
        }

        if ($question->getId() && $question instanceof Question && !$question->getOrigData()) {
            $question = $this->hydrator->hydrate(
                $this->get($question->getId()),
                $this->hydrator->extract($question)
            );
        }

        try {
            $this->resource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $question;
    }

    /**
     * Load Question data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return QuestionSearchResults
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria): QuestionSearchResults
    {
        $collection = $this->questionCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Question
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\QuestionInterface $question): bool
    {
        try {
            $this->resource->delete($question);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete question by given question Identity
     *
     * @param string $questionId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(string $questionId): bool
    {
        $question = $this->get($questionId);
        return $this->delete($question);
    }
}
