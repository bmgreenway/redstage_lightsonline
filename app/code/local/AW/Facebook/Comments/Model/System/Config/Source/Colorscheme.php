<?php

class AW_Facebook_Comments_Model_System_Config_Source_Colorscheme
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'light', 'label' => Mage::helper('facebookcomments')->__('Light')),
            array('value' => 'dark', 'label' => Mage::helper('facebookcomments')->__('Dark')),
        );
    }

}