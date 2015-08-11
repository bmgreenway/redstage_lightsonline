<?php

class AW_Twitter_Tweet_Block_Cms_Tweetbutton extends AW_Twitter_Tweet_Block_Abstract
{
    protected function _toHtml()
    {
        if ($this->_getHelper()->isShowInCms()){
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
