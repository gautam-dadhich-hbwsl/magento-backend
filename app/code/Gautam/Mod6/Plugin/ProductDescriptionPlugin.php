<?php
namespace Gautam\Mod6\Plugin;

use Magento\Catalog\Block\Product\View\Description;
use Psr\Log\LoggerInterface;

class ProductDescriptionPlugin
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    // if we are using this then it will load after the plugin was dispatched from the admin side
    // public function afterToHtml(Description $subject, $result)
    // {
    //     $this->logger->info('ProductDescriptionPlugin::afterToHtml is called.');
    //     $customDescription = 'sample description';
    //     return $customDescription;
    // }
    public function aroundToHtml(Description $subject, \Closure $proceed)
    {
        $this->logger->info('ProductDescriptionPlugin::aroundToHtml is called.');
        $result = $proceed();
        $customDescription = 'sample description';
        return $customDescription . $result; // Append or prepend custom description
    }
}
