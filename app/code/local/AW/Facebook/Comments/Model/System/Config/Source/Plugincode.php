<?php

class AW_Facebook_Comments_Model_System_Config_Source_Plugincode
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'xfbml', 'label' => Mage::helper('facebookcomments')->__('XFBML')),
            array('value' => 'html5', 'label' => Mage::helper('facebookcomments')->__('HTML5')),
        );
    }

}