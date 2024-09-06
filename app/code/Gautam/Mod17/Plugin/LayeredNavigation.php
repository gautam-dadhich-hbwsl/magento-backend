<?php
namespace Gautam\Mod17\Plugin;

use Magento\Catalog\Model\Layer\FilterList;
use Gautam\Mod17\Model\Layer\Filter\Rating;

class LayeredNavigation
{
    public function afterGetFilters(FilterList $subject, $result)
    {
        // Add custom rating filter to the list
        $result[] = $subject->getFilter(Rating::class);
        return $result;
    }
}
