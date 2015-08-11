<?php

class AW_Twitter_Follow_Model_System_Config_Source_Buttoncode
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
			array('value' => 'javascript',	'label' => Mage::helper('twitterfollow')->__('Using Javascript')),
			array('value' => 'iframe',		'label' => Mage::helper('twitterfollow')->__('Using an IFRAME')),
		);
	}

}
