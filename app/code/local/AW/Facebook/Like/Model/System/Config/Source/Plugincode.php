<?php

class AW_Facebook_Like_Model_System_Config_Source_Plugincode
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'xfbml', 'label' => Mage::helper('facebookilike')->__('XFBML')),
            array('value' => 'iframe', 'label' => Mage::helper('facebookilike')->__('iframe')),
            array('value' => 'html5', 'label' => Mage::helper('facebookilike')->__('HTML5')),
        );
    }

}
