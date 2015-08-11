<?php

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$entityTypeId = $setup->getEntityTypeId('customer');
$idAttributeOldSelect = $setup->getAttribute($entityTypeId, 'twitter_post', 'attribute_id');
$setup->updateAttribute($entityTypeId, $idAttributeOldSelect, array(
    'frontend_input' => 'select',
    'source_model'	=> 'eav/entity_attribute_source_boolean',
));