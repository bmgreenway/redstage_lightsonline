<?php

class AW_Twitter_Connect_Block_Customer_Form_Twitterconnect extends Mage_Core_Block_Template
{
	public function getIsPostToTwitter()
	{
		return Mage::helper('twitterconnect')->isPostEnabled();
	}

	public function getAction()
	{
		return $this->getUrl('*/*/save');
	}
}
