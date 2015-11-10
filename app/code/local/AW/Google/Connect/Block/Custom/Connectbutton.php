<?php

class AW_Google_Connect_Block_Custom_Connectbutton extends AW_Google_Connect_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('googleconnect')->isCustomButtonEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}