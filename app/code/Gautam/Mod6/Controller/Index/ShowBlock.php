<?php
namespace Gautam\Mod6\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\LayoutFactory;

class ShowBlock extends Action
{
    protected $layoutFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        LayoutFactory $layoutFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // Create a layout and render the block
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock(\Gautam\Mod6\Block\CustomBlock::class);
        $html = $block->toHtml();

        // Return the HTML as a response
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        return $result->setContents($html);
    }
}
