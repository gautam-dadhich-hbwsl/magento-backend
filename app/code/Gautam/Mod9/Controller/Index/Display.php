<?php

namespace Gautam\Mod9\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Display extends Action
{
    protected $scopeConfig;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        // Get the configuration values
        $isEnabled = $this->scopeConfig->getValue('mod9_section/mod9_group/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $textToDisplay = $this->scopeConfig->getValue('mod9_section/mod9_group/text_to_display', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);

        if ($isEnabled) {
            $result->setContents($textToDisplay);
        } else {
            $result->setContents('The feature is not Enabled yet!!.');
        }

        return $result;
    }
}
