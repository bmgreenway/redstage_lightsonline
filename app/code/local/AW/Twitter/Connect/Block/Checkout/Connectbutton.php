<?php

class AW_Twitter_Connect_Block_Checkout_Connectbutton extends AW_Twitter_Connect_Block_Abstract
{
	protected function _toHtml()
	{
		if(Mage::helper('twitterconnect')->isCheckoutPageButtonEnabled()) {
			return parent::_toHtml();
		} else {
			return '';
		}
    }
}