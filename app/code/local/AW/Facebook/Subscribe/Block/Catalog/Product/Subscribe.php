<?php

class AW_Facebook_Subscribe_Block_Catalog_Product_Subscribe extends AW_Facebook_Subscribe_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('facebooksubscribe')->isShowOnProductPage() &&  $facebook = Mage::helper('facebooksubscribe')->getFacebook()){
            return $facebook->getFacebookHtml().parent::_toHtml();
        }else {
            return '';
        }
    }
}
