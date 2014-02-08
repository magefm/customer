<?php

class MageFM_Customer_CepController extends Mage_Core_Controller_Front_Action
{

    public function buscarAction()
    {
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        $result = array();

        try {
            $cep = preg_replace('/([^0-9]*)/', '', $this->getRequest()->getParam('cep'));

            if (strlen($cep) != 8) {
                throw new Exception(Mage::helper('magefm_customer')->__('CEP não encontrado. Preencha manualmente os dados.'));
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http://brcep.com.br/?' . http_build_query(array(
                'formato' => $this->getRequest()->getParam('formato', 'json'),
                'cep' => $this->getRequest()->getParam('cep'),
            )));

            $content = curl_exec($ch);

            if (!$content) {
                throw new Exception(Mage::helper('magefm_customer')->__('CEP não encontrado. Preencha manualmente os dados.'));
            }

            $result = Zend_Json::decode($content);

            if (empty($result['resultado'])) {
                throw new Exception(Mage::helper('magefm_customer')->__('CEP não encontrado. Preencha manualmente os dados.'));
            }
        } catch (Exception $e) {
            $result = array('resultado' => '0', 'message' => $e->getMessage());
        }

        $this->getResponse()->setBody(Zend_Json::encode($result));
    }

}