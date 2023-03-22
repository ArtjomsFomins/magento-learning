<?php
namespace Learning\Brand\Observer;

use Psr\Log\LoggerInterface;

class Logger implements \Magento\Framework\Event\ObserverInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->logger->debug($observer->getEvent()->getObject()->getName());
    }
}
