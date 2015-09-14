<?php
$installer = $this;

$installer->startSetup();


/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'mark_as_energy_star' => array (
          'group'                      => 'General',
          'type'                       => 'int',
          'label'                      => 'Mark as Energy Star',
          'input'                      => 'select',
		  'default'  					=> '0',
		  'source'   => 'eav/entity_attribute_source_boolean',
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
          'is_configurable'            => '1',
          'apply_to'                   => 'simple,configurable',
          'visible_in_advanced_search' => '1',
          'position'                   => '1',
		)
);

foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode, $attributeParams);
}
 
$installer->endSetup();