<?php

$query = "
CREATE TABLE IF NOT EXISTS `{$this->getTable('googleconnect/synch')}` (
	`synch_id`				int(10) unsigned NOT NULL AUTO_INCREMENT,
	`customer_id`			int(10) unsigned NULL,
	`google_id`				varchar(50) NOT NULL,
	`access_token`			text NOT NULL,
	`googleconnect_cookie`	varchar(30) NOT NULL,
	PRIMARY KEY (`synch_id`),
	CONSTRAINT `FK_GOOGLECONNECT_SYNCH_CUSTOMER_ID` FOREIGN KEY (`customer_id`) REFERENCES `{$this->getTable('customer/entity')}` (`entity_id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='Google Connect Synch Table';
";

$installer = $this;
$installer->startSetup();
$installer->run($query);
$installer->endSetup();
