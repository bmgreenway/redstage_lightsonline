<?php


class AW_Twitter_Connect_Block_Login extends Mage_Core_Block_Template
{
	public function getAuthUrl()
	{
	    return Mage::registry('twitter_auth_url');
	}
}