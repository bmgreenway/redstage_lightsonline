<?php
$installer = $this;

$installer->startSetup();


/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'room' => array (
	  'group'                      => 'Product Options',
	  'type'                       => 'int',
	  'label'                      => 'Room',
	  'input'                      => 'select',
	  'required'                   => '0',
	  'user_defined'               => '1',
	  'global'                     => '1',
	  'visible'                    => '1',
	  'searchable'                 => '1',
	  'filterable'                 => '1',
	  'comparable'                 => '1',
	  'visible_on_front'           => '1',
	  'is_html_allowed_on_front'   => '1',
	  'filterable_in_search'       => '1',
	  'used_in_product_listing'    => '1',
	  'is_configurable'            => '0',
	  'apply_to'                   => 'simple,configurable',
	  'visible_in_advanced_search' => '1',
	  'position'                   => '1',
	  'used_for_promo_rules'       => '1' ,
	  'option'                     => array (
									 'values' => array (
											  0 => 'Living Room',
											  1 => 'Conference Room',
											  2 => 'Rest Room'											  
                                            ),
									  )
    )
);

foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode, $attributeParams);
}

$installer->endSetup();