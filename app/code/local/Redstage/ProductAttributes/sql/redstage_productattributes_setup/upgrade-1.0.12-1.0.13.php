<?php
$installer = $this;

$installer->startSetup();

$installer->removeAttribute(Mage_Catalog_Model_Category::ENTITY, 'overlay_content');
$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
/* Add attribute group to attribute set */
$productAttributesInfo =
array(
		'overlay_content' => array (
		'group'			=> 'General Information',
		'input' 		=> 'textarea',
		'type'      	=> 'varchar',
		'backend' 		=> '',
		'label'     	=> 'Overlay Content',
		'required'  	=> '0',
		'global'   		=> Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
		'visible'   	=> true,
		'required'  	=> false,
		'user_defined' 	=> false,
		'is_wysiwyg_enabled' => '1',        
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