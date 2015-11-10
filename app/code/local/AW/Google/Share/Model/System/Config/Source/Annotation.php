<?php

class AW_Google_Share_Model_System_Config_Source_Annotation
{
    /**
     * Options getter
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'bubble', 'label' => Mage::helper('googleshare')->__('Bubble(horizontal)')),
            array('value' => 'inline', 'label' => Mage::helper('googleshare')->__('Inline')),
            array('value' => 'vertical-bubble', 'label' => Mage::helper('googleshare')->__('Bubble(vertical)')),
            array('value' => 'none', 'label' => Mage::helper('googleshare')->__('None')),
        );
    }

}
