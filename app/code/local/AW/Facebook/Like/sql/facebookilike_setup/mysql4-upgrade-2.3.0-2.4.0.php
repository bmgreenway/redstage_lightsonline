<?php
$installer = $this;
$installer->startSetup();

$installer->run("
    CREATE TABLE IF NOT EXISTS `{$this->getTable('facebookilike/like')}` (
      `id` int(11) unsigned NOT NULL auto_increment,
      `customer_id` int(11) unsigned NOT NULL,
      `like_time` int(11) unsigned NOT NULL,
      `url` text NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();