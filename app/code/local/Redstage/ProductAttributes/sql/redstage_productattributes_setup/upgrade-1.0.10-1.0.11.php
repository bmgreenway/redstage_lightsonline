<?php
$installer = $this;

$installer->startSetup();

$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'megamenu_image' => array (
          'group'         => 'General Information',
		  'input'	=> 'image',
          'type'                      => 'varchar',
		  'backend' => 'catalog/category_attribute_backend_image',
          'label'                      => 'MegaMenu Image',
          'required'                   => '0',
          'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
          'visible'           => true,
          'required'          => false,
          'user_defined'      => false,          
  )
);

$installer->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'megamenu_image',
    '12'                    
);
foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Category::ENTITY, $attributeCode, $attributeParams);
}

$installer->endSetup();