<?php
namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Question::class, QuestionResourceModel::class);
    }
}
