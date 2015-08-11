<?php

class AW_Google_Plusone_Block_Cms_Button extends AW_Google_Plusone_Block_Abstract
{
    protected function _toHtml()
    {
        $controller_name = Mage::app()->getFrontController()->getRequest()->getControllerName();

        if ($this->_getHelper()->isShowInHome() && $controller_name == 'index'){
            return parent::_toHtml().$this->_getHelper()->getGoogleJsHtml();
        } else if($this->_getHelper()->isShowInCms() && $controller_name == 'page'){
            return parent::_toHtml().$this->_getHelper()->getGoogleJsHtml();
        }else {
            return '';
        }
    }

    /**
     * @return AW_Google_Plusone_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('googleplusone');
    }
}