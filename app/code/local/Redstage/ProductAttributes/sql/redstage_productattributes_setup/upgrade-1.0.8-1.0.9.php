<?php
$installer = $this;

$installer->startSetup();


/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'group_info' => array (
          'group'                      => 'Product Options',
          'type'                       => 'int',
          'label'                      => 'Energy Group Info',
          'input'                      => 'select',
          'required'                   => '0',
          'user_defined'               => '1',
          'global'                     => '1',
          'visible'                    => '1',
          'visible_in_advanced_search' => '1',
          'option'                     => array (
                                          'values' => array (
                                              0 => 'fan_group_a',
                                              1 => 'fan_group_b',
                                              2 => 'fan_group_c',
                                              3 => 'fan_group_d',
                                            ),
                                          ),
    ),
);

foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode, $attributeParams);
}
 
$installer->endSetup();