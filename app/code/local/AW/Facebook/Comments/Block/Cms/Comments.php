<?php

class AW_Facebook_Comments_Block_Cms_Comments extends AW_Facebook_Comments_Block_Abstract
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

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $controller_name = Mage::app()->getFrontController()->getRequest()->getControllerName();
        $home_page = $this->_getHelper()->isShowInHome() && $controller_name == 'index';
        $cms_page = $this->_getHelper()->isShowInCms() && $controller_name == 'page';
        if (($home_page || $cms_page) && !Mage::registry('aw_facebook_comments_insert_html_params') && $head = $this->getLayout()->getBlock('head'))
        {
            $head->setChild('cms_facebookcommentsmeta', $this->getLayout()->createBlock('facebookcomments/cms_commentsmeta'));
            Mage::register('aw_facebook_comments_insert_html_params', true);
        }

        return $this;
    }


    /**
     * @return AW_Facebook_Comments_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookcomments');
    }
}
