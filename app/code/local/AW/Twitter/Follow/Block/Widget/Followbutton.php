<?php

class AW_Twitter_Follow_Block_Widget_Followbutton
	extends AW_Twitter_Follow_Block_Abstract
	implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        if ($this->_getHelper()->isShowWidget()){
            return parent::_toHtml().$this->_getHelper()->getTwitterHtml();
        }else {
            return '';
        }
    }

    /**
     * @return AW_Twitter_Follow_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('twitterfollow');
    }
}
