<?php
namespace Gautam\Mod8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Gautam\Mod8\Model\EmployeeFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Delete extends Action
{
    protected $dataPersistor;
    protected $employeeFactory;
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        EmployeeFactory $employeeFactory,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->employeeFactory = $employeeFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $employee = $this->employeeFactory->create();
            try {
                $employee->load($id);
                if ($employee->getId()) {
                    $employee->delete();
                    $this->messageManager->addSuccessMessage(__('Employee has been deleted.'));
                } else {
                    $this->messageManager->addErrorMessage(__('Employee does not exist.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while deleting the employee.'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('No employee ID provided.'));
        }
        
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('mod8/index/view');
    }
}
