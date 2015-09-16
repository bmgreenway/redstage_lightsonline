<?php
$installer = $this;

$installer->startSetup();


/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'color' => array (
          'group'                      => 'General',
          'type'                       => 'int',
          'label'                      => 'Color',
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
          'is_configurable'            => '1',
          'apply_to'                   => 'simple',
          'visible_in_advanced_search' => '1',
          'position'                   => '1',
          'used_for_promo_rules'       => '1',
          'option'                     => array (
                                          'values' => array (
                                              0 => 'Green',
                                              1 => 'Silver',
                                              2 => 'Black',
                                              3 => 'Blue',
                                              4 => 'Red',
                                              5 => 'Pink',
                                              6 => 'Magneta',
                                              7 => 'Brown',
                                              8 => 'White',
                                              9 => 'Gray'
                                            ),
                                          ),
    ),
    'size' => array (
        'group'                      => 'General',
        'type'                       => 'int',
        'label'                      => 'Size',
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
        'is_configurable'            => '1',
        'apply_to'                   => 'simple',
        'visible_in_advanced_search' => '1',
        'position'                   => '1',
        'used_for_promo_rules'       => '1',
        'option'                     => array (
                'values' => array (
                        0 => '1',
                        1 => '2',
                        2 => '3',
                        3 => '4',
                        4 => '5',
                        5 => '6',
                        6 => '7',
                        7 => '8',
                        8 => '9',
                        9 => '10'
                ),
        ),
)
);

foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode, $attributeParams);
}

$installer->endSetup();