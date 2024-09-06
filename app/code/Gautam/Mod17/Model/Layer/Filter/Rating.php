<?php
namespace Gautam\Mod17\Model\Layer\Filter;

use Magento\Catalog\Model\Layer\Filter\AbstractFilter;
use Magento\Framework\DB\Select;

class Rating extends AbstractFilter
{
    protected function _getItemsData()
    {
        // Custom logic to gather rating filter options (e.g., 1-star, 2-star, etc.)
        $items = [
            ['label' => '1 Star', 'value' => 1, 'count' => 10],
            ['label' => '2 Stars', 'value' => 2, 'count' => 20],
            ['label' => '3 Stars', 'value' => 3, 'count' => 30],
            ['label' => '4 Stars', 'value' => 4, 'count' => 40],
            ['label' => '5 Stars', 'value' => 5, 'count' => 50]
        ];

        $data = [];
        foreach ($items as $item) {
            $data[] = [
                'label' => __($item['label']),
                'value' => $item['value'],
                'count' => $item['count']
            ];
        }

        return $data;
    }

    protected function applyFilterToCollection($value)
    {
        // Apply filtering logic to product collection
        $this->getLayer()->getProductCollection()->addAttributeToFilter('rating_summary', $value);
        return $this;
    }
}
    