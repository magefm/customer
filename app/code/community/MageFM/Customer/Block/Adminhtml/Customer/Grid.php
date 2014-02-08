<?php

class MageFM_Customer_Block_Adminhtml_Customer_Grid extends Mage_Adminhtml_Block_Customer_Grid
{

    protected function _prepareColumns()
    {
        parent::_prepareColumns();

        $this->removeColumn('Telephone');
        $this->removeColumn('billing_postcode');
        $this->removeColumn('billing_country_id');
        $this->removeColumn('billing_region');

        $tipos = Mage::getModel('magefm_customer/source_tipopessoa')->getKeyValueOptions();

        $this->addColumn('tipopessoa', array(
            'header' => Mage::helper('magefm_customer')->__('Tipo pessoa'),
            'width' => '100',
            'index' => 'tipopessoa',
            'type' => 'options',
            'options' => $tipos
        ));

        $this->addColumn('cpf', array(
            'header' => Mage::helper('magefm_customer')->__('CPF'),
            'width' => '100',
            'index' => 'cpf',
        ));

        $this->addColumn('cnpj', array(
            'header' => Mage::helper('magefm_customer')->__('CNPJ'),
            'width' => '100',
            'index' => 'cnpj',
        ));

        $this->addColumnsOrder('tipopessoa', 'entity_id');
        $this->addColumnsOrder('cpf', 'email');
        $this->addColumnsOrder('cnpj', 'cpf');
        $this->sortColumnsByOrder();

        return $this;
    }

    public function setCollection($collection)
    {
        $collection->addAttributeToSelect('tipopessoa');
        $collection->addAttributeToSelect('cpf');
        $collection->addAttributeToSelect('cnpj');

        parent::setCollection($collection);
    }

}