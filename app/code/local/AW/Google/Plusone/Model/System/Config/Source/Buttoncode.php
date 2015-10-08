<?php

class AW_Google_Plusone_Model_System_Config_Source_Buttoncode
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
			array('value' => 'google',	'label' => Mage::helper('googleplusone')->__('Using Google tag')),
			array('value' => 'html',	'label' => Mage::helper('googleplusone')->__('Using HTML tag')),
		);
	}
}
