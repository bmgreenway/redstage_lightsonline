<?php

$installer = $this;
$this->getConnection()->addColumn(
    $this->getTable('carousel/slide'),
    'store_id',
    'INT NOT NULL DEFAULT 1'
);
$this->getConnection()->addForeignKey(
    'FK_REDSTAGE_CAROUSEL_SLIDE_STORE_ID_CORE_STORE_STORE_ID',
    $this->getTable('carousel/slide'),
    'store_id',
    $this->getTable('core/store'),
    'store_id'
);
