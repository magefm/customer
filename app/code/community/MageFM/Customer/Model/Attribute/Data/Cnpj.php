<?php

class MageFM_Customer_Model_Attribute_Data_Cnpj extends Mage_Eav_Model_Attribute_Data_Text
{

    public function extractValue(Zend_Controller_Request_Http $request)
    {
        $value = preg_replace('/([^0-9]*)/', '', parent::extractValue($request));

        if (strlen($value) == 14) {
            $value = str_pad($value, 15, '0', STR_PAD_LEFT);
        }

        return $value;
    }

    public function validateValue($value)
    {
        if ($this->getExtractedData('tipopessoa') != 'PJ') {
            return true;
        }

        $errors = array();

        try {
            if (strlen($value) != 15) {
                throw new Exception();
            }

            for ($t = 13; $t < 15; $t++) {
                for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
                    $d += $value{$c} * $p;
                    $p = ($p < 3) ? 9 : --$p;
                }
                $d = ((10 * $d) % 11) % 10;

                if ($value{$c} != $d) {
                    throw new Exception();
                }
            }
        } catch (Exception $e) {
            $errors[] = Mage::helper('magefm_customer')->__('Invalid CNPJ.');
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