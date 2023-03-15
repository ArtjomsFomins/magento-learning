<?php

/**
 * Magebit_PageListWidget
 *
 * @category     Magebit
 * @package      Magebit_PageListWidget
 * @author       Artjoms Fomins <info@magebit.com>
 * @copyright    Copyright (c) 2023 Magebit, Ltd.(https://www.magebit.com/)
 */

declare(strict_types=1);

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

/**
 * Class that responsible for module logic
 *
 */
class PageList extends Template implements OptionSourceInterface, BlockInterface
{
    /**
     * @var string */
    protected $template = "page-list.phtml";
    /**
     * @var PageRepositoryInterface */
    private PageRepositoryInterface $pageRepositoryInterface;

    /**
     * @var SearchCriteriaBuilder */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * Cms constructor
     *
     * @param PageRepositoryInterface $pageRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Template\Context $context
     * @param array $data
     */
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
    /**
     * Function which return cms pages in prettier version
     *
     * @return array
     */
    public function toOptionArray(): array
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
    /**
     * Function that return all cms pages
     *
     * @return array
     */
    protected function getCmsPageCollection(): array
    {
        $searchCriteria = $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->pageRepositoryInterface->getList($searchCriteria)->getItems();
    }

    /**
     * Return the filtered array of selected pages depening of selected user's pages
     *
     * @return array
     */
    public function getListOfPages()
    {
        if ($this->getData('display') === 'all') {
            return $this->toOptionArray();
        }

        $selectedPages = explode(',', $this->getData('display_pages'));

        return array_filter($this->toOptionArray(), function ($v) use ($selectedPages) {
            if (in_array($v['value'], $selectedPages)) {
                return $v;
            }
        });
    }
}
