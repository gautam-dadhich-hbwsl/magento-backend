<?php
namespace Gautam\Mod2\Plugin;

use Magento\Theme\Block\Html\Breadcrumbs;

class BreadcrumbPlugin
{
    public function afterGetBreadcrumbs(Breadcrumbs $subject, $result)
    {
        return 'Hummingbird ' . $result;
    }
}
