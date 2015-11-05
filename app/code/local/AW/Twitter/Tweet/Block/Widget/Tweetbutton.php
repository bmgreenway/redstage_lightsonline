<?php

class AW_Twitter_Tweet_Block_Widget_Tweetbutton
	extends AW_Twitter_Tweet_Block_Abstract
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
     * @return AW_Twitter_Tweet_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('twittertweet');
    }
}
