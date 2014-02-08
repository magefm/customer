<?php

class MageFM_Customer_Block_Checkout_Onepage_Customer extends Mage_Checkout_Block_Onepage_Abstract
{

    protected function _construct()
    {
        if ($this->isShow()) {
            $this->getCheckout()->setStepData('customer', array(
                'label' => Mage::helper('magefm_customer')->__('Customer Information'),
                'is_show' => true,
                'allow' => false
            ));
        }

        parent::_construct();
    }

    public function isShow()
    {
        return !$this->isCustomerLoggedIn();
    }

}