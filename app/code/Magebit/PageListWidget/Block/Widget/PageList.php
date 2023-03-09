<?php

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class PageList extends Template implements OptionSourceInterface,BlockInterface
{
    protected $_template = "page-list.phtml";
    private PageRepositoryInterface $pageRepositoryInterface;
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        PageRepositoryInterface $pageRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Template\Context $context,
        array $data = []
    ) {
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
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
    protected function getCmsPageCollection()
    {
        $searchCriteria = $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->pageRepositoryInterface->getList($searchCriteria)->getItems();
    }

    /**
     * Return the filtered array of selected pages
     *
     * @return array
     */
    public function getListOfPages()
    {
        if($this->getData('display') === 'all') {
            return $this->toOptionArray();
        }

        $selectedPages = explode(',', $this->getData('display_pages') );

        return array_filter($this->toOptionArray(), function($v) use ($selectedPages) {
            if(in_array($v['value'],$selectedPages)) {
                return $v;
            }
        });
    }
}
