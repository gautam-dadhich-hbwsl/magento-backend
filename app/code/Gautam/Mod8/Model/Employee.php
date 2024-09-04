<?php
namespace Gautam\Mod8\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Exception\LocalizedException;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Gautam\Mod8\Model\ResourceModel\Employee::class);
    }

    protected function _beforeSave()
    {
        // Remove employee_id validation on creation since it will be auto-generated
        if ($this->getId()) {
            if (!preg_match('/^EMP\d+$/', $this->getData('employee_id'))) {
                throw new LocalizedException(__('Invalid Employee ID.'));
            }
        }

        if (!preg_match('/^[a-zA-Z]{1,30}$/', $this->getData('first_name'))) {
            throw new LocalizedException(__('Invalid First Name.'));
        }

        if (!preg_match('/^[a-zA-Z]{1,30}$/', $this->getData('last_name'))) {
            throw new LocalizedException(__('Invalid Last Name.'));
        }

        if (!filter_var($this->getData('email_id'), FILTER_VALIDATE_EMAIL)) {
            throw new LocalizedException(__('Invalid Email ID.'));
        }

        if (strlen($this->getData('address')) <= 30) {
            throw new LocalizedException(__('Address must be greater than 30 characters.'));
        }

        if (!preg_match('/^\d{10}$/', $this->getData('phone_number'))) {
            throw new LocalizedException(__('Phone Number must be exactly 10 digits.'));
        }

        return parent::_beforeSave();
    }

    protected function _afterSave()
    {
        if (!$this->getData('employee_id')) {
            $this->setData('employee_id', 'EMP' . $this->getId());
            $this->save();
        }

        return parent::_afterSave();
    }
}
