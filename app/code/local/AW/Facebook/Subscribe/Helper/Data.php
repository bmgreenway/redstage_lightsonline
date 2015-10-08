<?php

class AW_Facebook_Subscribe_Helper_Data extends AW_Facebook_Core_Helper_Data
{
    const VAR_HREF        = 'href';
    const VAR_WIDTH       = 'width';
    const VAR_LAYOUT      = 'layout';
    const VAR_SHOW_FACES  = 'show_faces';
    const VAR_COLORSCHEME = 'colorscheme';

    //general settings
    public function getPluginCode()
    {
        return Mage::getStoreConfig('facebooksubscribe/general/plugin_code', Mage::app()->getStore()->getId());
    }

    public function getFollowUrl()
    {
        return Mage::getStoreConfig('facebooksubscribe/general/href', Mage::app()->getStore()->getId());
    }

    public function getLayoutStyle()
    {
        return Mage::getStoreConfig('facebooksubscribe/general/layout', Mage::app()->getStore()->getId());
    }

    public function isShowFaces()
    {
        return Mage::getStoreConfig('facebooksubscribe/general/show_faces', Mage::app()->getStore()->getId());
    }

    public function getColorscheme()
    {
        return Mage::getStoreConfig('facebooksubscribe/general/colorscheme', Mage::app()->getStore()->getId());
    }

    public function getWidth()
    {
        return Mage::getStoreConfig('facebooksubscribe/general/width', Mage::app()->getStore()->getId());
    }

    //content settings

    public function isShowInCms()
    {
        return Mage::getStoreConfig('facebooksubscribe/content/show_in_cms', Mage::app()->getStore()->getId());
    }

    public function isShowInHome()
    {
        return Mage::getStoreConfig('facebooksubscribe/content/show_in_home', Mage::app()->getStore()->getId());
    }

    public function isShowInCategoryPage()
    {
        return Mage::getStoreConfig('facebooksubscribe/content/show_in_category', Mage::app()->getStore()->getId());
    }

    public function isShowOnProductPage()
    {
        return Mage::getStoreConfig('facebooksubscribe/content/show_in_product', Mage::app()->getStore()->getId());
    }

    public function isShowCustom()
    {
        return Mage::getStoreConfig('facebooksubscribe/content/show_custom', Mage::app()->getStore()->getId());
    }

    public function isShowWidget()
    {
        return Mage::getStoreConfig('facebooksubscribe/content/show_widget', Mage::app()->getStore()->getId());
    }
}