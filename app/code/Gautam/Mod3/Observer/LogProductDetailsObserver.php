<?php
namespace Gautam\Mod3\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\InventorySalesAdminUi\Model\GetSalableQuantityDataBySku;
use Magento\Inventory\Model\SourceItemRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;

class LogProductDetailsObserver implements ObserverInterface
{
    protected $logger;
    protected $salableQty;
    protected $sourceItemRepository;
    protected $searchCriteriaBuilder;

    public function __construct(
        LoggerInterface $logger,
        GetSalableQuantityDataBySku $salableQty,
        SourceItemRepository $sourceItemRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->logger = $logger;
        $this->salableQty = $salableQty;
        $this->sourceItemRepository = $sourceItemRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function execute(Observer $observer)
    {
        // Get the product from the event
        /** @var ProductInterface $product */
        $product = $observer->getEvent()->getProduct();

        if ($product) {
            $productName = $product->getName();
            $sku = $product->getSku();
            $price = $product->getPrice();

            // Loging product details
            $this->logger->info('Product Name: ' . $productName);
            $this->logger->info('SKU: ' . $sku);
            $this->logger->info('Price: ' . $price);

            // Getting Salable Quantity
            $salableQtyData = $this->salableQty->execute($sku);
            foreach ($salableQtyData as $salableQty) {
                $this->logger->info('Salable Quantity for Stock ID ' . $salableQty['stock_id'] . ': ' . $salableQty['qty']);
            }

            // Building search criteria to filter by SKU
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter('sku', $sku, 'eq')
                ->create();

            // Getting Quantity per Source
            $sourceItems = $this->sourceItemRepository->getList($searchCriteria)->getItems();
            foreach ($sourceItems as $sourceItem) {
                $this->logger->info('Source: ' . $sourceItem->getSourceCode() . ' | Quantity: ' . $sourceItem->getQuantity());
            }
        }

        return $this;
    }
}
