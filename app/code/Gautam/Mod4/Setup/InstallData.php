<?php
namespace Gautam\Mod4\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\Store\Model\StoreManagerInterface;

class InstallData implements InstallDataInterface
{
    protected $urlRewriteFactory;
    protected $storeManager;

    public function __construct(
        UrlRewriteFactory $urlRewriteFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->urlRewriteFactory = $urlRewriteFactory;
        $this->storeManager = $storeManager;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $rewrite = $this->urlRewriteFactory->create();
        $rewrite->setData([
            'request_path' => 'contactuspage.html',
            'target_path' => 'contact/index/index',
            'redirect_type' => 0,
            'store_id' => $this->storeManager->getStore()->getId(),
        ]);
        $rewrite->save();
    }
}
