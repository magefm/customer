<?php

/** @var Mage_Customer_Model_Resource_Setup $this */
$this->startSetup();

// Add customer attributes
$entityTypeId = $this->getEntityTypeId('customer');

$this->addAttribute($entityTypeId, 'tipopessoa', array(
    'input' => 'select',
    'type' => 'varchar',
    'label' => 'Tipo pessoa',
    'source' => 'magefm_customer/source_tipopessoa',
    'required' => true,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
));

$this->addAttribute($entityTypeId, 'cpf', array(
    'input' => 'text',
    'type' => 'varchar',
    'label' => 'CPF',
    'required' => true,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
    'data_model' => 'magefm_customer/attribute_data_cpf',
));

$this->addAttribute($entityTypeId, 'telefone', array(
    'input' => 'text',
    'type' => 'varchar',
    'label' => 'Telefone',
    'required' => true,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
));

$this->addAttribute($entityTypeId, 'cnpj', array(
    'input' => 'text',
    'type' => 'varchar',
    'label' => 'CNPJ',
    'required' => false,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
    'data_model' => 'magefm_customer/attribute_data_cnpj',
));

$this->addAttribute($entityTypeId, 'razao_social', array(
    'input' => 'text',
    'type' => 'varchar',
    'label' => 'Razão Social',
    'required' => false,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
));

$this->addAttribute($entityTypeId, 'inscricao_estadual', array(
    'input' => 'text',
    'type' => 'varchar',
    'label' => 'Inscrição Estadual',
    'required' => false,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
));

$this->addAttribute($entityTypeId, 'inscricao_estadual_isento', array(
    'input' => 'select',
    'type' => 'int',
    'source' => 'eav/entity_attribute_source_boolean',
    'label' => 'Isento de Inscrição Estadual',
    'required' => false,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
));

// Add brazilian states
$estados = array(
    'AC' => 'Acre',
    'AL' => 'Alagoas',
    'AP' => 'Amapá',
    'AM' => 'Amazonas',
    'BA' => 'Bahia',
    'CE' => 'Ceará',
    'DF' => 'Distrito Federal',
    'ES' => 'Espírito Santo',
    'GO' => 'Goiás',
    'MA' => 'Maranhão',
    'MT' => 'Mato Grosso',
    'MS' => 'Mato Grosso do Sul',
    'MG' => 'Minas Gerais',
    'PA' => 'Pará',
    'PB' => 'Paraíba',
    'PR' => 'Paraná',
    'PE' => 'Pernambuco',
    'PI' => 'Piauí',
    'RJ' => 'Rio de Janeiro',
    'RN' => 'Rio Grande do Norte',
    'RS' => 'Rio Grande do Sul',
    'RO' => 'Rondônia',
    'RR' => 'Roraima',
    'SC' => 'Santa Catarina',
    'SP' => 'São Paulo',
    'SE' => 'Sergipe',
    'TO' => 'Tocantins'
);

foreach ($estados as $sigla => $nome) {
    $this->run("INSERT INTO `{$this->getTable('directory/country_region')}` (`country_id`, `code`, `default_name`) VALUES ('BR', '{$sigla}', '{$nome}')");
}

// Add customer_address attributes
$entityTypeId = $this->getEntityTypeId('customer_address');

$this->addAttribute($entityTypeId, 'identification', array(
    'input' => 'text',
    'type' => 'varchar',
    'label' => 'Identification',
    'required' => true,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
));

$this->addAttribute($entityTypeId, 'mobilephone', array(
    'input' => 'text',
    'type' => 'varchar',
    'label' => 'Mobile phone',
    'required' => false,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
));

$this->addAttribute($entityTypeId, 'bairro', array(
    'input' => 'text',
    'type' => 'varchar',
    'label' => 'Bairro',
    'required' => true,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible' => true,
));

// Add quote attributes
$this->run("ALTER TABLE `{$this->getTable('sales/quote')}` ADD `customer_tipopessoa` VARCHAR(255) NOT NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/quote')}` ADD `customer_cpf` VARCHAR(255) NOT NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/quote')}` ADD `customer_telefone` VARCHAR(255) NOT NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/quote')}` ADD `customer_cnpj` VARCHAR(255) NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/quote')}` ADD `customer_razao_social` VARCHAR(255) NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/quote')}` ADD `customer_inscricao_estadual` VARCHAR(255) NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/quote')}` ADD `customer_inscricao_estadual_isento` BOOLEAN NULL;");

// Add order attributes
$this->run("ALTER TABLE `{$this->getTable('sales/order')}` ADD `customer_tipopessoa` VARCHAR(255) NOT NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/order')}` ADD `customer_cpf` VARCHAR(255) NOT NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/order')}` ADD `customer_telefone` VARCHAR(255) NOT NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/order')}` ADD `customer_cnpj` VARCHAR(255) NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/order')}` ADD `customer_razao_social` VARCHAR(255) NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/order')}` ADD `customer_inscricao_estadual` VARCHAR(255) NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/order')}` ADD `customer_inscricao_estadual_isento` BOOLEAN NULL;");

// Add quote_address attributes
$this->run("ALTER TABLE `{$this->getTable('sales/quote_address')}` ADD `identification` VARCHAR(255) NOT NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/quote_address')}` ADD `mobilephone` VARCHAR(255) NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/quote_address')}` ADD `bairro` VARCHAR(255) NOT NULL;");

// Add order_address attributes
$this->run("ALTER TABLE `{$this->getTable('sales/order_address')}` ADD `identification` VARCHAR(255) NOT NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/order_address')}` ADD `mobilephone` VARCHAR(255) NULL;");
$this->run("ALTER TABLE `{$this->getTable('sales/order_address')}` ADD `bairro` VARCHAR(255) NOT NULL;");

// Add configuration
$html = "<b>{{var identification}}</b>\r\n<br />\r\n{{var firstname}} {{var lastname}}\r\n<br />\r\n{{var street1}}, {{var street2}}{{depend street3}} - {{var street3}}{{/depend}}{{depend street4}} - {{var street4}}{{/depend}}\r\n<br />\r\n{{var bairro}} - {{var city}} - {{var region}} - {{var country}}\r\n<br />\r\nCEP: {{var postcode}}\r\n{{depend telephone}}<br />{{var telephone}}{{/depend}}\r\n{{depend mobilephone}}<br />{{var mobilephone}}{{/depend}}";
$text = "{{var identification}}\r\n{{var firstname}} {{var lastname}}\r\n{{var street1}}, {{var street2}}{{depend street3}} - {{var street3}}{{/depend}}{{depend street4}} - {{var street4}}{{/depend}}\r\n{{var bairro}} - {{var city}} - {{var region}} - {{var country}}\r\nCEP: {{var postcode}}{{depend telephone}}\r\n{{var telephone}}{{/depend}}{{depend mobilephone}}\r\n{{var mobilephone}}{{/depend}}";
$oneline = "{{var identification}} - {{var firstname}} {{var lastname}} - {{var street}}, {{var bairro}}, {{var city}}, {{var region}} {{var postcode}}, {{var country}}";
$pdf = "{{var firstname}} {{var lastname}}|\r\n{{var street1}}, {{var street2}} - {{var street3}} - {{var street4}}|\r\nCEP: {{var postcode}}|\r\n{{var bairro}}, {{var city}}, {{var region}}, {{var country}}|\r\n{{depend telephone}}{{var telephone}}{{/depend}}|\r\n{{depend mobilephone}}&lt;br/&gt;{{var mobilephone}}{{/depend}}|";
$js_template = "#{identification}&lt;br/&gt;#{firstname} #{lastname}&lt;br/&gt;#{street0}, #{street1} - #{street2} - #{street3}&lt;br/&gt;CEP: #{postcode}&lt;br/&gt;#{bairro}, #{city}, #{region}, #{country_id}&lt;br/&gt;#{telephone}&lt;br/&gt;#{mobilephone}";

Mage::app()->getConfig()->saveConfig('customer/address_templates/html', $html);
Mage::app()->getConfig()->saveConfig('customer/address_templates/text', $text);
Mage::app()->getConfig()->saveConfig('customer/address_templates/oneline', $oneline);
Mage::app()->getConfig()->saveConfig('customer/address_templates/pdf', $pdf);
Mage::app()->getConfig()->saveConfig('customer/address_templates/js_template', $js_template);
Mage::app()->getConfig()->saveConfig('customer/address/street_lines', '4');

$attribute = Mage::getSingleton('eav/config')->getAttribute('customer_address', 'street');
$attribute->setData('multiline_count', '4');
$attribute->save();

// Attributes sort order
$this->run("DELETE f FROM `{$this->getTable('customer/form_attribute')}` AS f INNER JOIN `{$this->getTable('eav/attribute')}` e ON e.attribute_id = f.attribute_id AND f.form_code = 'adminhtml_customer' AND e.attribute_code IN ('prefix', 'middlename', 'suffix', 'taxvat')");
$this->run("DELETE f FROM `{$this->getTable('customer/form_attribute')}` AS f INNER JOIN `{$this->getTable('eav/attribute')}` e ON e.attribute_id = f.attribute_id AND f.form_code = 'adminhtml_customer_address' AND e.attribute_code IN ('prefix', 'middlename', 'suffix', 'company', 'fax', 'vat_id')");

$sortOrder = array(
    0 => 'identification',
    10 => 'firstname',
    20 => 'lastname',
    30 => 'telephone',
    40 => 'mobilephone',
    50 => 'postcode',
    60 => 'country_id',
    70 => 'region',
    80 => 'city',
    90 => 'bairro',
    100 => 'street'
);

foreach ($sortOrder as $sortOrder => $attributeCode) {
    $attribute = Mage::getSingleton('eav/config')->getAttribute('customer_address', $attributeCode);
    $attribute->setData('sort_order', $sortOrder);
    $attribute->save();
}

// Attributes used_in_forms
$attributes = array('identification', 'mobilephone', 'bairro');

foreach ($attributes as $attributeCode) {
    $attribute = Mage::getSingleton('eav/config')->getAttribute('customer_address', $attributeCode);
    $attribute->setData('used_in_forms', array('customer_address_edit', 'adminhtml_customer_address'));
    $attribute->save();
}

$attributes = array('tipopessoa', 'cpf', 'telefone', 'cnpj', 'razao_social', 'inscricao_estadual', 'inscricao_estadual_isento');
$forms = array('customer_account_edit', 'customer_account_create', 'adminhtml_customer', 'checkout_register');

foreach ($attributes as $attributeCode) {
    $attribute = Mage::getSingleton('eav/config')->getAttribute('customer', $attributeCode);
    $attribute->setData('used_in_forms', $forms);
    $attribute->save();
}

$this->endSetup();
