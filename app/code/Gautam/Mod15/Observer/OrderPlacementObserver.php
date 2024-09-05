<?php
namespace Gautam\Mod15\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Gautam\Mod15\Model\OrderPlacementFactory;
use Magento\Customer\Model\Session;
use Psr\Log\LoggerInterface;
use Magento\Framework\Exception\LocalizedException;

class OrderPlacementObserver implements ObserverInterface
{
    protected $orderPlacementFactory;
    protected $customerSession;
    protected $logger;
    public function __construct(
        LoggerInterface $logger,
        OrderPlacementFactory $orderPlacementFactory,
        Session $customerSession
    ) {
        $this->logger= $logger;
        $this->orderPlacementFactory = $orderPlacementFactory;
        $this->customerSession = $customerSession;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $customerGroupId = $order->getCustomerGroupId();
        $totalSalesAmount = $order->getGrandTotal();
        // Group ID === 0 (Means they are not Logged In !!)
        if ($customerGroupId == 0) { 
            $this->logger->info("Order placed by customer group ID: " . $customerGroupId . ", Total: " . $totalSalesAmount);
            $orderPlacement = $this->orderPlacementFactory->create();
            $orderPlacement->setData([
                'customer_group_id' => $customerGroupId,
                'total_sales_amount' => $totalSalesAmount
            ]);
            $orderPlacement->save();
        }
    }
}