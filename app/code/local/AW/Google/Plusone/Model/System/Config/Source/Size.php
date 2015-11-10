<?php

class AW_Google_Plusone_Model_System_Config_Source_Size
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
			array('value' => 'small',		'label' => Mage::helper('googleplusone')->__('Small')),
			array('value' => 'medium',		'label' => Mage::helper('googleplusone')->__('Medium')),
			array('value' => 'standard',	'label' => Mage::helper('googleplusone')->__('Standard')),
			array('value' => 'tall',		'label' => Mage::helper('googleplusone')->__('Tall')),
		);
	}
}
