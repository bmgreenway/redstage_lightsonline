<?php

class AW_Facebook_Comments_Helper_Enterprise extends AW_Facebook_Core_Helper_Data
{
    const VAR_HREF        = 'href';
    const VAR_NUM_POSTS   = 'num_posts';
    const VAR_WIDTH       = 'width';
    const VAR_COLORSCHEME = 'colorscheme';

    //general settings
    public function getPluginCode()
    {
        return Mage::getStoreConfig('facebookcomments/general/plugin_code', Mage::app()->getStore()->getId());
    }

    public function getCommentUrl()
    {
        $value = Mage::getStoreConfig('facebookcomments/general/href', Mage::app()->getStore()->getId());
        return $value ? $value : Mage::helper('core/url')->getCurrentUrl();
    }

    public function getNumberPosts()
    {
        return Mage::getStoreConfig('facebookcomments/general/num_posts', Mage::app()->getStore()->getId());
    }

    public function getWidth()
    {
        return Mage::getStoreConfig('facebookcomments/general/width', Mage::app()->getStore()->getId());
    }

    public function getColorscheme()
    {
        return Mage::getStoreConfig('facebookcomments/general/colorscheme', Mage::app()->getStore()->getId());
    }

    //content settings

    public function isShowInCms()
    {
        return Mage::getStoreConfig('facebookcomments/content/show_in_cms', Mage::app()->getStore()->getId());
    }

    public function isShowInHome()
    {
        return Mage::getStoreConfig('facebookcomments/content/show_in_home', Mage::app()->getStore()->getId());
    }

    public function isShowOnProductPage()
    {
        return Mage::getStoreConfig('facebookcomments/content/show_in_product', Mage::app()->getStore()->getId());
    }

    public function isShowCustom()
    {
        return Mage::getStoreConfig('facebookcomments/content/show_custom', Mage::app()->getStore()->getId());
    }

    public function isShowWidget()
    {
        return Mage::getStoreConfig('facebookcomments/content/show_widget', Mage::app()->getStore()->getId());
    }
}
