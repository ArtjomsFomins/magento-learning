<?php

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CmsPages extends \Magento\Framework\View\Element\Template implements OptionSourceInterface
{

    private $pageRepositoryInterface;


    private $searchCriteriaBuilder;


    public function __construct(
        PageRepositoryInterface $pageRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }


    public function toOptionArray()
    {
        $optionArray = [];
            $pages = $this->getCmsPageCollection();
            $cnt = 0;
            foreach ($pages as $page) {
                $optionArray[$cnt]['value'] = $page->getIdentifier();
                $optionArray[$cnt++]['label'] = $page->getTitle();
            }
        return $optionArray;
    }
    public function getCmsPageCollection()
    {
        $searchCriteria = $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->pageRepositoryInterface->getList($searchCriteria)->getItems();
    }
}
