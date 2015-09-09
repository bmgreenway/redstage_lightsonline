<?php
$installer = $this;

$installer->startSetup();

$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
/* Add attribute group to attribute set */
$productAttributesInfo =
array(
    'featured_category' => array (
          'group'         => 'General Information',
          'type'                       => 'int',
          'label'                      => 'Featured Category',
          'input'                      => 'select',
            'default'                        => '0',
            'source'   => 'eav/entity_attribute_source_boolean',
          'required'                   => '0',
          'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
         'visible'           => true,
         'required'          => false,
         'user_defined'      => false,
         'default'           => 0
          )
);

$installer->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'featured_category',
    '11'                      //last Magento's attribute position in General tab is 10
);
foreach ($productAttributesInfo as $attributeCode => $attributeParams) {
    $installer->addAttribute(Mage_Catalog_Model_Category::ENTITY, $attributeCode, $attributeParams);
}

//$installer->removeAttribute('catalog_category', 'featured_category');
$installer->endSetup();