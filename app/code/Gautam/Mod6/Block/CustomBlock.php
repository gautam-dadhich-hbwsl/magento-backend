<?php
namespace Gautam\Mod6\Block;

use Magento\Framework\View\Element\Template;

class CustomBlock extends Template
{
    // Overriding _toHtml() to render custom HTML
    protected function _toHtml()
    {
        return '<h1>This is first custom content from CustomBlock</h1>';
    }

    // Overriding _afterToHtml() to modify the HTML after rendering
    protected function _afterToHtml($html)
    {
        return $html . '<p>Appending content after the main HTML, that is after HTML.</p>';
    }
}
