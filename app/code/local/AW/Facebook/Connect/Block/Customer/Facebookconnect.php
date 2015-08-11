<?php

class AW_Facebook_Connect_Block_Customer_Facebookconnect extends AW_Facebook_Connect_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('facebookconnect')->isLoginPageButtonEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}
