<?php

class AW_Facebook_Connect_Block_Widget_Facebookconnect
    extends AW_Facebook_Connect_Block_Abstract
    implements Mage_Widget_Block_Interface
{
    public function getTitle()
    {
        $title = $this->getData('title');
        return $title ? $title : parent::getTitle();
    }

    protected function _toHtml()
    {
        if (Mage::helper('facebookconnect')->isWidgetButtonEnabled()) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}
