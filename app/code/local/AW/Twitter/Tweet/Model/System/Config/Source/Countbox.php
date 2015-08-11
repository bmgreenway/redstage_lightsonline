<?php

class AW_Twitter_Tweet_Model_System_Config_Source_Countbox
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
			array('value' => 'none',		'label' => Mage::helper('twittertweet')->__('None')),
			array('value' => 'horizontal',	'label' => Mage::helper('twittertweet')->__('Horizontal')),
			array('value' => 'vertical',	'label' => Mage::helper('twittertweet')->__('Vertical')),
		);
	}

}
