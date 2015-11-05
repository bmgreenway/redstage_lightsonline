<?php

class AW_Google_Share_Block_Widget_Button
	extends AW_Google_Share_Block_Abstract
	implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        if ($this->_getHelper()->isShowWidget()){
            return parent::_toHtml().$this->_getHelper()->getGoogleJsHtml();
        }else {
            return '';
        }
    }

    /**
     * @return AW_Google_Share_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('googleshare');
    }
}