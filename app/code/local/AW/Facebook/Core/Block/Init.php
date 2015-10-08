<?php
/**
 * Created by PhpStorm.
 * User: truhan_v
 * Date: 24.04.14
 * Time: 13:40
 */
class AW_Facebook_Core_Block_Init extends Mage_Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('facebookcore/init.phtml');
    }

    public function getFacebookLocale()
    {
        return $this->_getHelper()->getLocaleCode();
    }

    /**
     * @return AW_Facebook_Core_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookcore');
    }

    public function getFacebookAppId()
    {
        return $this->getFacebook()->getAppId();
    }

    public function _isLikeInstalled()
    {
        return Mage::helper('core')->isModuleEnabled('AW_Facebook_Like');
    }
}