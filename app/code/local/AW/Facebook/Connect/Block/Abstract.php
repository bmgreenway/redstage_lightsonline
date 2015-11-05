<?php

class AW_Facebook_Connect_Block_Abstract extends Mage_Core_Block_Template
{
    public function getLinkUrl()
    {
        return $this->_getHelper()->getFacebook()->getConnectUrl();
    }

    public function getTitle()
    {
        $title = $this->_getHelper()->getTitle();
        return $title ? $title : $this->_getHelper()->__('Sign in with Facebook');
    }

    protected function _toHtml()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }

        $html = parent::_toHtml();
        if ($this->_getHelper()->isFacebookHtmlDisplayed()) {
            return $html;
        }
        $this->_getHelper()->setFacebookHtmlDisplayed();
        $html = strval($this->_getHelper()->getFacebookHtml()) . $html;
        Mage::getSingleton('customer/session')->setUrlAfterFacebookLogin(Mage::helper('core/url')->getCurrentUrl());
        return $html;
    }

    /**
     * @return AW_Facebook_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookconnect');
    }
}