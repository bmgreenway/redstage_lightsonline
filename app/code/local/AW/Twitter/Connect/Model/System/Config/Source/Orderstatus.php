<?php

class AW_Twitter_Connect_Model_System_Config_Source_Orderstatus
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return Mage::getSingleton('sales/order_config')->getStatuses();
	}

}