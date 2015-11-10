<?php


class AW_Twitter_Follow_Block_Catalog_Product_Followbutton extends AW_Twitter_Follow_Block_Abstract
{
    protected function _toHtml()
    {
        if ($this->_getHelper()->isShowOnProductPage()){
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
