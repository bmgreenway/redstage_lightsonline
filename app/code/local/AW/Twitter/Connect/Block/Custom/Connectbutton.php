<?php

class AW_Twitter_Connect_Block_Custom_Connectbutton extends AW_Twitter_Connect_Block_Abstract
{
	protected function _toHtml()
	{
		if(Mage::helper('twitterconnect')->isCustomButtonEnabled()) {
			return parent::_toHtml();
		} else {
			return '';
		}
    }
}