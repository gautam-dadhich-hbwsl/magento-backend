<?php
namespace Gautam\Mod18\Plugin;

use Psr\Log\LoggerInterface;

class ProductPricePlugin
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result + 1.79;
    }
}