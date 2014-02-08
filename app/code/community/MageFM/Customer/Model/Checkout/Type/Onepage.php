<?php

class MageFM_Customer_Model_Checkout_Type_Onepage extends Mage_Checkout_Model_Type_Onepage
{

    public function saveCustomer($data)
    {
        if (empty($data)) {
            return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid data.'));
        }

        if (!$this->getQuote()->getCustomerId() && self::METHOD_REGISTER == $this->getQuote()->getCheckoutMethod()) {
            if ($this->_customerEmailExists($data['email'], Mage::app()->getWebsite()->getId())) {
                return array('error' => 1, 'message' => Mage::helper('checkout')->__('There is already a customer registered using this email address. Please login using this email address or enter a different email address to register your account.'));
            }
        }

        $this->_validateCustomer($data);
        $this->getQuote()->save();

        $this->getCheckout()
                ->setStepData('customer', 'allow', true)
                ->setStepData('customer', 'complete', true)
                ->setStepData('billing', 'allow', true);

        return array();
    }

    protected function _validateCustomerData(array $data)
    {
        if ($this->getCheckoutMethod() == self::METHOD_GUEST || $this->getCheckoutMethod() == self::METHOD_REGISTER) {
            return true;
        }

        return $this->_validateCustomer($data);
    }

    protected function _validateCustomer(array $data)
    {
        return parent::_validateCustomerData($data);
    }

}