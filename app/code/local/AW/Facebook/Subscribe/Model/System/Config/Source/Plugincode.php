<?php

class AW_Facebook_Subscribe_Model_System_Config_Source_Plugincode
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'xfbml', 'label' => Mage::helper('facebooksubscribe')->__('XFBML')),
            array('value' => 'iframe', 'label' => Mage::helper('facebooksubscribe')->__('Iframe')),
            array('value' => 'html5', 'label' => Mage::helper('facebooksubscribe')->__('HTML5')),
        );
    }

}
