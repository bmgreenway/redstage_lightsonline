<?php

class AW_Twitter_Follow_Model_System_Config_Source_Alignment
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
			array('value' => 'left',	'label' => Mage::helper('twitterfollow')->__('Left')),
			array('value' => 'right',	'label' => Mage::helper('twitterfollow')->__('Right')),
		);
	}

}
