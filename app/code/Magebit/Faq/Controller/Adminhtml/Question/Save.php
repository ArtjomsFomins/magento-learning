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

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save question action.
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    protected DataPersistorInterface $dataPersistor;
    private QuestionFactory $questionFactory;
    private QuestionRepositoryInterface $questionRepository;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param QuestionFactory|null $questionFactory
     * @param QuestionRepositoryInterface|null $questionRepository
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        QuestionFactory $questionFactory = null,
        QuestionRepositoryInterface $questionRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->questionFactory = $questionFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(QuestionFactory::class);
        $this->questionRepository = $questionRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(QuestionRepositoryInterface::class);

        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Question::STATUS_ENABLED;
            }
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            $model = $this->questionFactory->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->questionRepository->get($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This question no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->questionRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the question.'));
                $this->dataPersistor->clear('question_block');
                return $this->processBlockReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
            }

            $this->dataPersistor->set('question_block', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process and set the question return
     *
     * @param \Magebit\Faq\Model\Question $model
     * @param array $data
     * @param ResultInterface $resultRedirect
     * @return ResultInterface
     */
    private function processBlockReturn($model, $data, $resultRedirect): ResultInterface
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect === 'continue') {
            $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        } else {
            $resultRedirect->setPath('*/*/index');
        }

        return $resultRedirect;
    }
}
