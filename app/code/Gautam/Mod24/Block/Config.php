<?php

namespace Mod24\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class Config extends Template
{
    protected $_scopeConfig;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    // Fetch Sales Emails configuration
    public function getSalesEmails()
    {
        return $this->_scopeConfig->getValue('sales_email', ScopeInterface::SCOPE_STORE);
    }

    // Fetch Payment Methods configuration
    public function getPaymentMethods()
    {
        return $this->_scopeConfig->getValue('payment', ScopeInterface::SCOPE_STORE);
    }

    // Fetch Shipping configuration
    public function getShippingConfig()
    {
        return $this->_scopeConfig->getValue('carriers', ScopeInterface::SCOPE_STORE);
    }

    // Fetch Tax configuration
    public function getTaxConfig()
    {
        return $this->_scopeConfig->getValue('tax', ScopeInterface::SCOPE_STORE);
    }

    // Fetch Store Information
    public function getStoreInformation()
    {
        return $this->_scopeConfig->getValue('general/store_information', ScopeInterface::SCOPE_STORE);
    }

    // Fetch other general store configurations if needed
    public function getGeneralConfig()
    {
        return $this->_scopeConfig->getValue('general', ScopeInterface::SCOPE_STORE);
    }

    // Prepare data to be passed to the JavaScript component
    public function getJsConfig()
    {
        return json_encode([
            'salesEmails' => $this->getSalesEmails(),
            'paymentMethods' => $this->getPaymentMethods(),
            'shippingConfig' => $this->getShippingConfig(),
            'taxConfig' => $this->getTaxConfig(),
            'storeInformation' => $this->getStoreInformation(),
            'generalConfig' => $this->getGeneralConfig()
        ]);
    }
}
