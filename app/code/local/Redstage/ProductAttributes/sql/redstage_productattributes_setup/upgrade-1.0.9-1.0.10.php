<?php
$installer = $this;

$installer->startSetup();


/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'has_energy_guide' => array (
          'group'                      => 'Product Options',
          'type'                       => 'int',
          'label'                      => 'Has Energy Guide',
          'input'                      => 'select',
		  'default'  					=> '0',
		  'source'   => 'eav/entity_attribute_source_boolean',
          'required'                   => '0',
          'user_defined'               => '1',
          'global'                     => '1',
          'visible'                    => '1',
		  'is_used_for_promo_rules' => 1,
		),
);

foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode, $attributeParams);
}
 
$installer->endSetup();