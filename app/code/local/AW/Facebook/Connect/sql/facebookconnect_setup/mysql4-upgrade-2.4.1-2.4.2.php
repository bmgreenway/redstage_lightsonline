<?php
$installer = $this;
$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$setup->addAttribute(
    'customer',
    'fb_access_token',
    array(
        'type'     => 'varchar',
        'label'    => 'Access Token',
        'input'    => 'text',
        'default'  => NULL,
        'visible'  => false,
        'required' => false,
    )
);
$installer->endSetup();