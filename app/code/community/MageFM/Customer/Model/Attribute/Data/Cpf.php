<?php

class MageFM_Customer_Model_Attribute_Data_Cpf extends Mage_Eav_Model_Attribute_Data_Text
{

    protected $_invalidValues = array('11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999', '00000000000');

    public function extractValue(Zend_Controller_Request_Http $request)
    {
        return preg_replace('/([^0-9]*)/', '', parent::extractValue($request));
    }

    public function validateValue($value)
    {
        $errors = array();

        try {
            if (strlen($value) != 11) {
                throw new Exception();
            }

            if (in_array($value, $this->_invalidValues)) {
                throw new Exception();
            }

            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $value{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($value{$c} != $d) {
                    throw new Exception();
                }
            }
        } catch (Exception $e) {
            $errors[] = Mage::helper('magefm_customer')->__('Invalid CPF.');
        }

        if (count($errors)) {
            return $errors;
        }

        return true;
    }

    public function compactValue($value)
    {
        return parent::compactValue(preg_replace('/([^0-9]*)/', '', $value));
    }

}