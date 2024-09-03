<?php
namespace Gautam\Mod5\Plugin;

class ProductViewPlugin
{
    public function afterToHtml(\Magento\Catalog\Block\Product\View $subject, $result)
    {
        return $result . '<p>Gautam this side creating Best Plugins.</p>';
    }
}
