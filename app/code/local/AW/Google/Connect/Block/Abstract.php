<?php

class AW_Google_Connect_Block_Abstract extends Mage_Core_Block_Template
{
    public function getTitle()
    {
        $title = $this->_getHelper()->getTitle();
        return $title ? $title : Mage::helper('googleconnect')->__('Sign in with Google');
    }

    public function getLinkUrl()
    {
        return Mage::getUrl('googleconnect/login', array('_secure' => Mage::getModel('core/url')->getSecure()));
    }

    protected function _toHtml()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }
        Mage::getSingleton('customer/session')->setUrlAfterGoogleLogin(Mage::helper('core/url')->getCurrentUrl());
        return parent::_toHtml();
    }

    /**
     * @return AW_Google_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('googleconnect');
    }
}