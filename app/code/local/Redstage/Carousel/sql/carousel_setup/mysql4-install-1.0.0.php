<?php

$installer = $this;
$installer->startSetup();
$installer->run("
DROP TABLE IF EXISTS {$this->getTable('carousel/slide')};

CREATE TABLE {$this->getTable('carousel/slide')} (
    `slide_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `active` BOOLEAN NOT NULL DEFAULT 0,
    `sort_order` INT NOT NULL DEFAULT 0,
    `name` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `caption` TEXT NOT NULL,
    `link` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`slide_id`)
);
");

$installer->endSetup();
