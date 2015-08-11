<?php

class AW_Facebook_Like_Block_Custom_Facebookilike extends AW_Facebook_Like_Block_Abstract
{
    protected function _prepareLayout()
    {
//        parent::_prepareLayout();
//
//        if (Mage::helper('facebookilike')->getCfg(AW_Facebook_Core_Helper_Data::VAR_SHOW_CUSTOM)
//            && (!Mage::registry('aw_facebookilikemeta_inserted'))
//            && ($head = $this->getLayout()->getBlock('head'))
//        ) {
//            $head->setChild('custom_facebookilikemeta', $this->getLayout()->createBlock('facebookilike/custom_facebookilikemeta'));
//
//            Mage::register('aw_facebookilikemeta_inserted', true);
//        }

        return $this;
    }

    protected function _toHtml()
    {
//        if (Mage::helper('facebookilike')->getCfg(AW_Facebook_Core_Helper_Data::VAR_SHOW_CUSTOM)
//            && ($facebook = Mage::helper('facebookilike')->getFacebook())
//        ) {
//            return $facebook->getFacebookHtml() . parent::_toHtml();
//        } else {
//            return '';
//        }
    }
}
