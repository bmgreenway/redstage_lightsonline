<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento enterprise edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Helpdesk3
 * @version    3.3.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE IF NOT EXISTS {$this->getTable('aw_lib/logger')} (
        `id` int(11) NOT NULL auto_increment,
        `title` varchar(255)  NOT NULL,
        `severity` varchar(255) NOT NULL default 1,
        `content` mediumtext  NOT NULL,
        `module` varchar(255)  NOT NULL,
        `file_info` mediumtext  NOT NULL,
        `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
        PRIMARY KEY  (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();