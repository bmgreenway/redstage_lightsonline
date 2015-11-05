<?php
$installer = $this;

$installer->startSetup();


/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'has_coupon' => array (
          'group'                      => 'Product Options',
          'type'                       => 'int',
          'label'                      => 'Has Coupon',
          'input'                      => 'select',
		  'default'  					=> '0',
		  'source'   => 'eav/entity_attribute_source_boolean',
          'required'                   => '0',
          'user_defined'               => '1',
          'global'                     => '1',
          'visible'                    => '1',
		  'is_used_for_promo_rules' => 1,
		),
	 'custom_price_lightfinder' => array (
          'group'                      => 'Product Options',
          'type'                       => 'int',
          'label'                      => 'Custom Price Range',
          'input'                      => 'select',
          'required'                   => '0',
          'user_defined'               => '1',
          'global'                     => '1',
          'visible'                    => '1',
          'visible_in_advanced_search' => '1',
          'option'                     => array (
                                          'values' => array (
                                              0 => '$100-$200',
                                              1 => '$200-$300',
                                              2 => '$300-$400',
                                              3 => '$500-$1000',
                                            ),
                                          ),
    ),
);

foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode, $attributeParams);
}
 
$installer->endSetup();