<?php
namespace Gautam\Mod2\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;

class ProductPlugin
{
    public function afterGetName(ProductInterface $subject, $result)
    {
        $price = $subject->getPrice();
        
        if ($price < 20) {
              $result .= " WholeSale !!";
        } elseif ($price >= 20 && $price < 50) {
            $result .= " Super Sale!! (Discounted Price: " . $this->calculateDiscountedPrice($price) . ")";
        } elseif ($price >= 50) {
            $result .= " Premium!!";
        }

        return $result;
    }

    private function calculateDiscountedPrice($price)
    {
        return round($price * 0.85, 2); 
    }
}
