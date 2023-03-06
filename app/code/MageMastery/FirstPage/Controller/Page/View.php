<?php

declare(strict_types = 1);

namespace Magemastery\FirstPage\Controller\Page;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;

class View implements ActionInterface
{
    /**
     * @var PageFactory
     */
    private JsonFactory $resultJsonFactory;

    /**
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(JsonFactory $resultJsonFactory)
    {
        $this->resultJsonFactory = $resultJsonFactory;
    }

    /**
     * @return Json
     */
    public function execute() : Json
    {
        $jsonResult = $this->resultJsonFactory->create();
        $jsonResult->setData([
            'message' => 'My First Page'
        ]);
        return $jsonResult;
    }
}
