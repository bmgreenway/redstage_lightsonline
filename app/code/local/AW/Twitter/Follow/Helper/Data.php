<?php

class AW_Twitter_Follow_Helper_Data extends Mage_Core_Helper_Abstract
{
    const WIDGETS_JS_URL	= '://platform.twitter.com/widgets.js';
    const IFRAME_URL		= 'http://platform.twitter.com/widgets/';
    const TWITTER_URL		= 'http://twitter.com/';


    //general settings
    public function getUserName()
    {
        static $user_name = null;
        if (is_null($user_name)) {
            $user_name = Mage::getStoreConfig('twitterfollow/general/user_name', Mage::app()->getStore()->getId());
            $user_name = $user_name ? str_replace('@', '', $user_name) : 'aheadWorks';
        }
        return $user_name;
    }

    public function getButtonCode()
    {
        static $button_code = null;
        if (is_null($button_code)) {
            $button_code = Mage::getStoreConfig('twitterfollow/general/button_code', Mage::app()->getStore()->getId());
        }
        return $button_code;
    }

    public function isShowCount()
    {
        static $show_count = null;
        if (is_null($show_count)) {
            $show_count = Mage::getStoreConfig('twitterfollow/general/show_count', Mage::app()->getStore()->getId());
        }
        return $show_count;
    }

    public function getWidth()
    {
        static $width = null;
        if (is_null($width)) {
            $width = Mage::getStoreConfig('twitterfollow/general/width', Mage::app()->getStore()->getId());
        }
        return $width;
    }

    public function getHeight()
    {
        static $height = null;
        if (is_null($height)) {
            $height = Mage::getStoreConfig('twitterfollow/general/height', Mage::app()->getStore()->getId());
        }
        return $height;
    }

    public function getAlign()
    {
        static $align = null;
        if (is_null($align)) {
            $align = Mage::getStoreConfig('twitterfollow/general/align', Mage::app()->getStore()->getId());
        }
        return $align;
    }

    //content settings

    public function isShowInCms()
    {
        return Mage::getStoreConfig('twitterfollow/content/show_in_cms', Mage::app()->getStore()->getId());
    }

    public function isShowInHome()
    {
        return Mage::getStoreConfig('twitterfollow/content/show_in_home', Mage::app()->getStore()->getId());
    }

    public function isShowOnProductPage()
    {
        return Mage::getStoreConfig('twitterfollow/content/show_in_product', Mage::app()->getStore()->getId());
    }

    public function isShowInCategoryPage()
    {
        return Mage::getStoreConfig('twitterfollow/content/show_in_category', Mage::app()->getStore()->getId());
    }

    public function isShowCustom()
    {
        return Mage::getStoreConfig('twitterfollow/content/show_custom', Mage::app()->getStore()->getId());
    }

    public function isShowWidget()
    {
        return Mage::getStoreConfig('twitterfollow/content/show_widget', Mage::app()->getStore()->getId());
    }

    public function getTwitterHtml()
    {
        $html = '';
        if (!Mage::registry('aw_twitter_html')) {
            $src = 'http'.(Mage::app()->getStore()->isCurrentlySecure() ? 's' : '').self::WIDGETS_JS_URL;
            $html = '
                <script type="text/javascript">
                    (function(){
                        var twitterWidgets = document.createElement("script");
                        twitterWidgets.type = "text/javascript";
                        twitterWidgets.async = true;
                        twitterWidgets.src = "'.$src.'";
                        document.getElementsByTagName("head")[0].appendChild(twitterWidgets);
                    })();
	            </script>';

            Mage::register('aw_twitter_html', true);
        }

        return $html;
    }
}
