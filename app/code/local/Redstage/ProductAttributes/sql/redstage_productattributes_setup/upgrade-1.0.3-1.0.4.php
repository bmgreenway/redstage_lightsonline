<?php
$installer = $this;

$installer->startSetup();


/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'height' => array (
	  'group'                      => 'Product Options',
	  'type'                       => 'int',
	  'label'                      => 'Height',
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
											  0 => '12',
											  1 => '13',
											  2 => '14'											  
                                            ),
									  )
    ),
	'width' => array (
	  'group'                      => 'Product Options',
	  'type'                       => 'int',
	  'label'                      => 'Width',
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
	  'used_for_promo_rules'       => '1',
	  'option'                     => array (
									 'values' => array (
											  0 => '12',
											  1 => '13',
											  2 => '14'											  
                                            ),
									  )
    ),
	 'brands' => array (
        'group'                      => 'Product Options',
        'type'                       => 'int',
        'label'                      => 'Brands',
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
        'apply_to'                   => 'simple,configurable',
        'visible_in_advanced_search' => '1',
        'position'                   => '1',
        'used_for_promo_rules'       => '1',
        'option'                     => array (
                'values' => array (
                        0 => 'Elk Lighting',
                        1 => 'Savoy House',
                        2 => 'Quoizel',
                        3 => 'Troy Lighting',
                        4 => 'George Kovacs',
                        5 => 'Access Lighting',
                        6 => 'Hudson Valley',
                        7 => 'Landmark',
                        8 => 'Minka Lavery',
                        9 => 'Schonbek'
                ),
        ),
	)
);

foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attributeCode, $attributeParams);
}

$installer->endSetup();