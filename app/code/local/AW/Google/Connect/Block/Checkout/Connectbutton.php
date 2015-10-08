<?php

class AW_Google_Connect_Block_Checkout_Connectbutton extends AW_Google_Connect_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('googleconnect')->isCheckoutPageButtonEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}