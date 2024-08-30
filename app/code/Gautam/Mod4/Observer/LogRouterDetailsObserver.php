<?php
namespace Gautam\Mod4\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\RequestInterface;

class LogRouterDetailsObserver implements ObserverInterface
{
    protected $logger;
    protected $request;

    public function __construct(
        LoggerInterface $logger,
        RequestInterface $request
    ) {
        $this->logger = $logger;
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        // Logging details about the current request
        $moduleName = $this->request->getModuleName();
        $controllerName = $this->request->getControllerName();
        $actionName = $this->request->getActionName();
        $requestUri = $this->request->getRequestUri();
        
        $this->logger->info('Request URI: ' . $requestUri);
        $this->logger->info('Module Name: ' . $moduleName);
        $this->logger->info('Controller Name: ' . $controllerName);
        $this->logger->info('Action Name: ' . $actionName);

        return $this;
    }
}
