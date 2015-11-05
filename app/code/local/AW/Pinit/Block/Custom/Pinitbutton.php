<?php


class AW_Pinit_Block_Custom_Pinitbutton extends AW_Pinit_Block_Abstract
{
    protected function _toHtml()
    {
        if ($this->_getHelper()->isShowCustom()){
            return parent::_toHtml().$this->_getHelper()->getPinitHtml();
        }else {
            return '';
        }
    }

    /**
     * @return AW_Pinit_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('pinit');
    }
}
