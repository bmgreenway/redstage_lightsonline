<?php
$installer = $this;
$installer->startSetup();
    //disable old module AW_FBIntegrator because of AW_FBIntegrator_Model_Facebook_Base_Facebook has class FacebookApiException.
    $query  = 'UPDATE `core_config_data` SET value = 1 WHERE `path` LIKE "advanced/modules_disable_output/AW_FBIntegrator"';
    $installer->run($query);
$installer->endSetup();