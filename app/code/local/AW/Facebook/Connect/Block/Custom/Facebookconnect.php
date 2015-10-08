<?php

class AW_Facebook_Connect_Block_Custom_Facebookconnect extends AW_Facebook_Connect_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('facebookconnect')->isCustomButtonEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}
