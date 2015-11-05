<?php

class AW_Facebook_Subscribe_Block_Widget_Subscribe
    extends AW_Facebook_Subscribe_Block_Abstract
    implements Mage_Widget_Block_Interface
{

    protected function _toHtml()
    {
        if (Mage::helper('facebooksubscribe')->isShowWidget() && $facebook = Mage::helper('facebooksubscribe')->getFacebook()){
            return $facebook->getFacebookHtml() . parent::_toHtml();
        } else {
            return '';
        }
    }
}