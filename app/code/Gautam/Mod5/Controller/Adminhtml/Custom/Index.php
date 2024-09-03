<?php
namespace Gautam\Mod5\Controller\Adminhtml\Custom;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\RequestInterface;

class Index extends Action
{
    protected $resultRedirectFactory;

    public function __construct(
        Action\Context $context,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // Get the "access" GET parameter
        $accessParam = $this->getRequest()->getParam('access');

        // Check if "access" is set and equals "true"
        if ($accessParam !== 'true') {
            // Redirect if "access" is not true
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('admin/dashboard/index'); // Redirect to admin dashboard
            return $resultRedirect;
        }

        // If access is true, proceed with the controller's logic
        $this->messageManager->addSuccessMessage(__('Access granted.'));
        return $this->_redirect('admin/custom/index');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Gautam_Mod5::custom_access');
    }
}
