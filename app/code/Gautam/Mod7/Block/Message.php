<?php
namespace Gautam\Mod7\Block;

use Magento\Framework\View\Element\Template;

class Message extends Template
{
    /**
     * Override _toHtml() to add custom logic.
     */
    protected function _toHtml()
    {
        return '<p>This is displayed by Gautam on all pages</p>';
    }

    /**
     * Override _afterToHtml() to add additional content.
     */
    protected function _afterToHtml($html)
    {
        return $html . '<p>Additional message from _afterToHtml() given by Lord Himself !!</p>';
    }
    public function HelloWorld(){
        return "<p>Hello World</p>";
    }
}
