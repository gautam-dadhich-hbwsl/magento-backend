<?php
namespace Gautam\Mod3\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Response\Http as HttpResponse;

class LogProductViewObserver implements ObserverInterface
{
    protected $logger;
    protected $response;

    public function __construct(
        LoggerInterface $logger,
        HttpResponse $response
    ) {
        $this->logger = $logger;
        $this->response = $response;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Getting the product from the event
        $product = $observer->getEvent()->getProduct();
        if ($product) {
            $productName = $product->getName();
            $this->logger->info('Product Viewed: ' . $productName);
        }

        // Logging the HTML content of the page
        $htmlContent = $this->response->getBody();
        $this->logger->info('Page HTML: ' . $htmlContent);

        return $this;
    }
}
