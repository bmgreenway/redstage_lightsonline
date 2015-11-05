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
 * @package    AW_Affiliate
 * @version    1.1.1
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Affiliate_Model_Source_Campaign_Type extends AW_Affiliate_Model_Source_Abstract
{
    const CPS = 'cps'; //cost per sale
    const CPC = 'cpc'; //cost per click

    const CPS_LABEL = 'cps';
    const CPC_LABEL = 'cpc';

    public function toOptionArray()
    {
        $helper = $this->_getHelper();
        return array(
            array('value' => self::CPS, 'label' => $helper->__(self::CPS_LABEL)),
            array('value' => self::CPC, 'label' => $helper->__(self::CPC_LABEL))
        );
    }
}
