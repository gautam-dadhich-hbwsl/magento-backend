<?php
namespace Gautam\Mod8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Gautam\Mod8\Model\EmployeeFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends Action
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
        $post = $this->getRequest()->getPostValue();
        if ($post) {
            $employee = $this->employeeFactory->create();
            $employee->setData($post);
            try {
                $employee->save();
                $this->messageManager->addSuccessMessage(__('Employee data has been saved.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while saving the employee data: ' . $e->getMessage()));
            }

            $this->dataPersistor->clear('employee_form_data');
        }

        return $this->resultRedirectFactory->create()->setPath('mod8/index/view');
    }
}

