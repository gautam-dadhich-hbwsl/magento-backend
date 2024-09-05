<?php

namespace Gautam\Mod14\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Catalog\Model\ProductRepository;

class LowInventoryObserver implements ObserverInterface
{
    protected $logger;
    protected $threshold = 10;
    protected $productRepository;

    public function __construct(
        LoggerInterface $logger,
        ProductRepository $productRepository
    ) {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $quantityAndStockStatus = $product->getQuantityAndStockStatus();

        if ($quantityAndStockStatus === null) {
            $this->logger->error('Quantity and stock status is null in low inventory observer.');
            return;
        }

        $qty = $quantityAndStockStatus['qty'];
        $isInStock = $quantityAndStockStatus['is_in_stock'];

        if ($isInStock && $qty < $this->threshold) {
            try {
                $this->logger->info(
                    sprintf(
                        'Low inventory alert: Product Name: %s, SKU: %s, Current Quantity: %d, Threshold: %d',
                        $product->getName(),
                        $product->getSku(),
                        $qty,
                        $this->threshold
                    )
                );
            } catch (\Exception $e) {
                $this->logger->error('Error logging low inventory alert: ' . $e->getMessage());
            }
        }
    }
}
