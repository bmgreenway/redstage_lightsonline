<?php
$installer = $this;

$installer->startSetup();


/* Add attribute group to attribute set */
$productAttributesInfo =
array(
	'energy_guide_identifier' => array (
	  'group'                      => 'Product Options',
	  'type'                       => 'varchar',
	  'label'                      => 'Energy Guide Identifier',
	  'input'                      => 'textarea',
	  'required'                   => '0',
	  'user_defined'               => '1',
	  'global'                     => '1',
	  'visible'                    => '1',
	  'searchable'                 => '0',
	  'filterable'                 => '0',
	  'comparable'                 => '0',
	  'visible_on_front'           => '0',
	  'is_html_allowed_on_front'   => '0',
	  'filterable_in_search'       => '0',
	  'used_in_product_listing'    => '0',
	  'is_configurable'            => '0',
	  'visible_in_advanced_search' => '0',
	  'position'                   => '1',
	  'used_for_promo_rules'       => '0' 
    ),    
);

foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode, $attributeParams);
}

$installer->endSetup();