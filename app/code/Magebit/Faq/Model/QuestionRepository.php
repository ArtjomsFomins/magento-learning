<?php


namespace Magebit\Faq\Model\ResourceModel;

use Magebit\Faq\Api\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function getById($customerId)
    {
        $customerModel = $this->customerRegistry->retrieve($customerId);
        return $customerModel->getDataModel();
    }
}
