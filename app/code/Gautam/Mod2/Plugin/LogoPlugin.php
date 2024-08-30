<?php
namespace Gautam\Mod2\Plugin;

use Magento\Catalog\Block\Product\View;
use Magento\Catalog\Api\Data\ProductInterface;

class LogoPlugin
{
    public function afterGetProductPriceHtml(View $subject, $result, ProductInterface $product)
    {
        $price = $product->getPrice();

        if ($price >= 20 && $price < 50) {
            $symbolHtml = '<img src="' . $subject->getViewFileUrl('Gautam_Mod2::images/sale.png') . '" alt="Sale" class="discount-symbol" />';
            $result = $symbolHtml . $result;
        }

        return $result;
    }
}
