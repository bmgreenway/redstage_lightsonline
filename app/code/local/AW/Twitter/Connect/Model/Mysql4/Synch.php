<?php

class AW_Twitter_Connect_Model_Mysql4_Synch extends Mage_Core_Model_Mysql4_Abstract
{
	protected function _construct()
	{
		$this->_init('twitterconnect/synch', 'synch_id');
	}
}