<?php

class AW_Twitter_Tweet_Model_System_Config_Source_Buttoncode
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
			array('value' => 'javascript',	'label' => Mage::helper('twittertweet')->__('Using Javascript')),
			array('value' => 'iframe',		'label' => Mage::helper('twittertweet')->__('Using an IFRAME')),
		);
	}

}
