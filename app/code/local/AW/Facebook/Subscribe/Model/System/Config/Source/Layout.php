<?php 
class AW_Facebook_Subscribe_Model_System_Config_Source_Layout
{
    public function toOptionArray()
	{
		return array(
			array('value' => 'standard',		'label' => 'standard'),
			array('value' => 'button_count',	'label' => 'button_count'),
			array('value' => 'box_count',		'label' => 'box_count'),
		);
	}
}