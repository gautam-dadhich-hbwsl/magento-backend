<?php
namespace Gautam\Mod1\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use \Gautam\Mod1\Test1;

class Index extends Action
{
    protected $test1;

    public function __construct(
        Context $context,
        Test1 $test1
    ) {
        $this->test1 = $test1;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo "HelloWorld\n\n";
        $this->test1->displayParams();
    }
}