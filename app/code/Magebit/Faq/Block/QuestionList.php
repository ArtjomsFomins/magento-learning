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

namespace Magebit\Faq\Block;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;

/**
 * Question content block
 */
class QuestionList extends \Magento\Framework\View\Element\Template implements BlockInterface
{
    private QuestionRepositoryInterface $questionRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private FilterBuilder $filterBuilder;
    private SortOrderBuilder $sortOrder;

    /**
     * Question constructor
     *
     * @param FilterBuilder $filterBuilder
     * @param SortOrderBuilder $sortOrder
     * @param QuestionRepositoryInterface $questionRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrder,
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Context $context,
        array $data = []
    ) {
        $this->filterBuilder = $filterBuilder;
        $this->sortOrder = $sortOrder;
        $this->questionRepository = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Function that returns all enabled questions and sorting them by position ASC
     *
     * @return array
     */
    public function getQuestions(): array
    {
        $status = $this->filterBuilder->setField('status')->setValue('1')->setConditionType('eq')->create();
        $sortOrder = $this->sortOrder->setField('position')->setDirection('ASC')->create();

        $this->searchCriteriaBuilder->addFilters([$status])->setSortOrders([$sortOrder]);
        $searchCriteria = $this->searchCriteriaBuilder->create();

        return  $this->questionRepository->getList($searchCriteria)->getItems();
    }
}
