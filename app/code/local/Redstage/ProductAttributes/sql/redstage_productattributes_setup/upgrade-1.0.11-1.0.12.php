<?php
$installer = $this;

$installer->startSetup();

$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'text_overlay' => array (
          'group'         => 'General Information',
      'input' => 'select',
          'type'                      => 'varchar',
      'backend' => 'eav/entity_attribute_backend_array',
          'label'                      => 'Text overlay',
          'option'        => array (
                              'value' => array('none'=>array(0=>'None'),'left'=>array(0=>'Left'),
'right'=>array(0=>'Right')
                       )),
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
    'text_overlay',
    '13'                    
);
foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Category::ENTITY, $attributeCode, $attributeParams);
}

$installer->endSetup();