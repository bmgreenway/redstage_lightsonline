<?php

class AW_Twitter_Connect_Block_Abstract extends Mage_Core_Block_Template
{
	public function getLinkUrl()
	{
		return Mage::getUrl('twitterconnect/login', array('_secure' => Mage::getModel('core/url')->getSecure()));
	}

	public function getTitle()
	{
		$title = $this->_getHelper()->getTitle();
		return $title ? $title : Mage::helper('twitterconnect')->__('Sign in with Twitter');
	}

    protected function _toHtml()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }
        Mage::getSingleton('customer/session')->setUrlAfterTwitterLogin(Mage::helper('core/url')->getCurrentUrl());
        return parent::_toHtml();
    }

    /**
     * @return AW_Twitter_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('twitterconnect');
    }
}