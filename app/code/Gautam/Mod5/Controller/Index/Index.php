<?php
namespace Gautam\Mod5\Controller\Index;

use Magento\Framework\App\Action\Action;

class Index extends Action
{

    public function execute()
    {
        $this->getResponse()->setBody('Hello World');
    }
}
