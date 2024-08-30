<?php
namespace Gautam\Mod4\Plugin\Router;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

class Base
{
    public function aroundMatch($subject, \Closure $proceed, RequestInterface $request)
    {
        $response = $proceed($request);
        if ($response === null) {
            $requestUri = $request->getRequestUri();

            if ($requestUri == '/notfoundpage.html') {
                $response = new \Magento\Framework\App\Response\Http();
                $response->setRedirect('/contactuspage.html');
            }
        }
        return $response;
    }
}
