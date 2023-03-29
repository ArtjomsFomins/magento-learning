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

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Validation\ValidationException;
use Magento\Framework\Validator\HTML\WYSIWYGValidatorInterface;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Backend\Model\Validator\UrlKey\CompositeUrlKey;
use Magento\Framework\Exception\LocalizedException;

/**
 * Question model
 *
 * @method Question setStoreId(int $storeId)
 * @method int getStoreId()
 */
class Question extends AbstractModel implements QuestionInterface
{
    /**
     * Question cache tag
     */
    public const CACHE_TAG = 'question_b';

    /**#@+
     * Question's statuses
     */
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'question_block';

    /**
     * @var WYSIWYGValidatorInterface
     */
    private $wysiwygValidator;

    /**
     * @var CompositeUrlKey
     */
    private $compositeUrlValidator;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     * @param WYSIWYGValidatorInterface|null $wysiwygValidator
     * @param CompositeUrlKey|null $compositeUrlValidator
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = [],
        ?WYSIWYGValidatorInterface $wysiwygValidator = null,
        CompositeUrlKey $compositeUrlValidator = null
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->wysiwygValidator = $wysiwygValidator
            ?? ObjectManager::getInstance()->get(WYSIWYGValidatorInterface::class);
        $this->compositeUrlValidator = $compositeUrlValidator
            ?? ObjectManager::getInstance()->get(CompositeUrlKey::class);
    }

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Magebit\Faq\Model\ResourceModel\Question::class);
    }

    /**
     * Retrieve question id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->getData(self::ID);
    }

    /**
     * Retrive question title
     *
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * Retrive question's answer
     *
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Retrive question status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Retrive question position
     *
     * @return int
     */
    public function getPosition(): int
    {
        return $this->getData(self::POSITION);
    }

    /**
     * Retrive question last modified time
     *
     * @return string
     */
    public function getUpdateAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set title
     *
     * @param string $question
     * @return QuestionInterface
     */
    public function setQuestion($question): QuestionInterface
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return QuestionInterface
     */
    public function setAnswer($answer): QuestionInterface
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Set status
     *
     * @param int $status
     * @return QuestionInterface
     */
    public function setStatus($status): QuestionInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set position
     *
     * @param int $position
     * @return QuestionInterface
     */
    public function setPosition($position): QuestionInterface
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * Prepare question's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Checks product can be duplicated
     *
     * @return boolean
     */
    public function isDuplicable()
    {
        return false;
    }
}
