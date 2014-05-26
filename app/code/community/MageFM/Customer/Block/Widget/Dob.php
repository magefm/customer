<?php

class MageFM_Customer_Block_Widget_Dob extends Mage_Customer_Block_Widget_Abstract
{

    protected $_date;
    protected $_inputFormat = 'dd/MM/yyyy';
    protected $_inputMask = '99/99/9999';
    protected $_dbFormat = 'YYYY-MM-dd HH:ii:ss';

    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('magefm/customer/widget/dob.phtml');
    }

    public function isEnabled()
    {
        return (bool) $this->_getAttribute('dob')->getIsVisible();
    }

    public function isRequired()
    {
        return (bool) $this->_getAttribute('dob')->getIsRequired();
    }

    public function setDate($date)
    {
        if ($date) {
            $this->_date = new Zend_Date($date, $this->_dbFormat);
        }
        return $this;
    }

    public function getValue()
    {
        if (!$this->_date) {
            return '';
        }

        return $this->_date->toString($this->_inputFormat);
    }

    public function getInputMask()
    {
        return $this->_inputMask;
    }

}