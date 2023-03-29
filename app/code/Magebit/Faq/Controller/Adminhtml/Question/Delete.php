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
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class that implement delete logic
 */
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    protected QuestionRepositoryInterface $questionRepository;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $this->questionRepository->deletebyId($id);
                $this->messageManager->addSuccessMessage(__('You deleted the question.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a question to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
