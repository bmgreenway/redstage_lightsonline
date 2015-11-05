<?php


class AW_Pinit_Block_Widget_Pinitbutton
	extends AW_Pinit_Block_Abstract
	implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        if ($this->_getHelper()->isShowWidget()){
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