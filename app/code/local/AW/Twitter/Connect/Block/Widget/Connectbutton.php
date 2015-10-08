<?php

class AW_Twitter_Connect_Block_Widget_Connectbutton
	extends AW_Twitter_Connect_Block_Abstract
	implements Mage_Widget_Block_Interface
{
	public function getTitle()
	{
		$title = $this->getData('title');
		return $title ? $title : parent::getTitle();
	}
	
	protected function _toHtml()
	{
		if(Mage::helper('twitterconnect')->isWidgetButtonEnabled()) {
			return parent::_toHtml();
		} else {
			return '';
		}
    }
}