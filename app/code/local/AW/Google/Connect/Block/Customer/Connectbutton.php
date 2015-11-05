<?php

class AW_Google_Connect_Block_Customer_Connectbutton extends AW_Google_Connect_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('googleconnect')->isLoginPageButtonEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}