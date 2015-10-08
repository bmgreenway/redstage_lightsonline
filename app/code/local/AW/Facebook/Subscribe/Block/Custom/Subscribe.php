<?php

class AW_Facebook_Subscribe_Block_Custom_Subscribe extends AW_Facebook_Subscribe_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('facebooksubscribe')->isShowCustom() && $facebook = Mage::helper('facebooksubscribe')->getFacebook()) {
            return $facebook->getFacebookHtml() . parent::_toHtml();
        } else {
            return '';
        }
    }
}
