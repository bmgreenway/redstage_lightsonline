<?php
class AW_Facebook_Subscribe_Block_Cms_Subscribe extends AW_Facebook_Subscribe_Block_Abstract
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
     * @return AW_Facebook_Subscribe_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebooksubscribe');
    }
}
