<?php

class AW_Pinit_Model_System_Config_Source_Pincount
{

	public function toOptionArray()
	{
		return array(
			array('value' => 'horizontal',	'label' => Mage::helper('pinit')->__('Horizontal')),
			array('value' => 'vertical',	'label' => Mage::helper('pinit')->__('Vertical')),
			array('value' => 'none',		'label' => Mage::helper('pinit')->__('No Count')),
		);
	}

}