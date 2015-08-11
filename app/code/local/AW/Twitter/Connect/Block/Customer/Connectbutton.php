<?php

class AW_Twitter_Connect_Block_Customer_Connectbutton extends AW_Twitter_Connect_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('twitterconnect')->isLoginPageButtonEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}