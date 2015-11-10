<?php

class AW_Google_Share_Model_System_Config_Source_Height
{
	/**
	 * Options getter
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
			array('value' => '15', 'label' => Mage::helper('googleshare')->__('Small')),
			array('value' => '20', 'label' => Mage::helper('googleshare')->__('Medium')),
			array('value' => '24', 'label' => Mage::helper('googleshare')->__('Large')),
		);
	}

}
