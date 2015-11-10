<?php

class AW_Facebook_Like_Block_Cms_Facebookilike extends AW_Facebook_Like_Block_Abstract
{
    protected function _toHtml()
    {
        $controller_name = Mage::app()->getFrontController()->getRequest()->getControllerName();
        if ($this->_getHelper()->isShowInHome() && $controller_name == 'index' && $facebook = $this->_getHelper()->getFacebook()){
            return $facebook->getFacebookHtml().parent::_toHtml();
        } else if($this->_getHelper()->isShowInCms() && $controller_name == 'page' && $facebook = $this->_getHelper()->getFacebook()){
            return $facebook->getFacebookHtml().parent::_toHtml();
        }else {
            return '';
        }
    }

    /**
     * @return AW_Facebook_Like_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookilike');
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $controller_name = Mage::app()->getFrontController()->getRequest()->getControllerName();
        $home_page = $this->_getHelper()->isShowInHome() && $controller_name == 'index';
        $cms_page = $this->_getHelper()->isShowInCms() && $controller_name == 'page';
        if (($home_page || $cms_page) && !Mage::registry('aw_facebookilikemeta_inserted') && $head = $this->getLayout()->getBlock('head'))
        {
            $head->setChild('cms_facebookilikemeta', $this->getLayout()->createBlock('facebookilike/custom_facebookilikemeta'));
            Mage::register('aw_facebookilikemeta_inserted', true);
        }

        return $this;
    }
}
