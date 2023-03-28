<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magebit\Faq\Block;

use Magento\Framework\View\Element\AbstractBlock;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

use Magento\Framework\View\Element\Template\Context;
use Magebit\Faq\Model\QuestionRepository;

use Magento\Framework\Api\FilterBuilder;

/**
 * Cms block content block
 * @deprecated This class introduces caching issues and should no longer be used
 * @see \Magebit\Faq\Block\BlockByIdentifier
 */
class QuestionList extends \Magento\Framework\View\Element\Template implements BlockInterface
{
    private QuestionRepository $questionRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    // private FilterBuilder $filterBuilder;

    /**
     * Cms constructor
     *
     *
     * @param QuestionRepository $questionRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        // FilterBuilder $filterBuilder,
        QuestionRepository $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Context $context,
        array $data = []
    ) {
        // $this->filterBuilder = $filterBuilder;
        $this->questionRepository = $questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    public function getQuestions()
    {
        // $filter = $this->filterBuilder->setField('status')->setValue('1')->setConditionType('where');
        // $this->searchCriteriaBuilder->addFilters([$filter]);
        try {
            //code...
            $searchCriteria = $this->searchCriteriaBuilder->create();
            $questions = $this->questionRepository->getList($searchCriteria);
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
        return 'hello!';
    }
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}
