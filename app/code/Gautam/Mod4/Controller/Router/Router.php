<?php
namespace Gautam\Mod4\Controller\Router;

use Magento\Framework\App\Router\Base as RouterBase;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\Action\Action;

class Router extends RouterBase
{
    protected $actionFactory;

    public function __construct(
        ActionFactory $actionFactory
    ) {
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('#^/([^/]+)/([^/]+)/([^/]+)$#', $pathInfo, $matches)) {
            $frontName = $matches[1];
            $controllerName = $matches[2];
            $actionName = $matches[3];

            $request->setModuleName($frontName)
                    ->setControllerName($controllerName)
                    ->setActionName($actionName);

            return $this->actionFactory->create(\Magento\Framework\App\Action\Action::class);
        }

        return null;
    }
}
