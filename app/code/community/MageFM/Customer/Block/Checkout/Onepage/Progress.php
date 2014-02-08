<?php

class MageFM_Customer_Block_Checkout_Onepage_Progress extends Mage_Checkout_Block_Onepage_Progress
{

    protected function _getStepCodes()
    {
        return array('login', 'customer', 'billing', 'shipping', 'shipping_method', 'payment', 'review');
    }

}