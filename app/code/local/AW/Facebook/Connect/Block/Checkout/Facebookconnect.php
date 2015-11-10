<?php

class AW_Facebook_Connect_Block_Checkout_Facebookconnect extends AW_Facebook_Connect_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('facebookconnect')->isCheckoutPageButtonEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}
