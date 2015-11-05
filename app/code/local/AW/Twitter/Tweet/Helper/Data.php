<?php

class AW_Twitter_Tweet_Helper_Data extends Mage_Core_Helper_Abstract
{
    const WIDGETS_JS_URL	= '://platform.twitter.com/widgets.js';
    const IFRAME_URL		= 'http://platform.twitter.com/widgets/';
    const TWITTER_URL		= 'http://twitter.com/';


    //general settings
    public function getButtonCode()
    {
        static $button_code = null;
        if (is_null($button_code)) {
            $button_code = Mage::getStoreConfig('twittertweet/general/button_code', Mage::app()->getStore()->getId());
        }
        return $button_code;
    }

    public function getVia()
    {
        static $via = null;
        if (is_null($via)) {
            $via = Mage::getStoreConfig('twittertweet/general/via', Mage::app()->getStore()->getId());
            $via = $via ? str_replace('@', '', $via) : 'aheadWorks';
        }
        return $via;
    }

    public function getDefaultText()
    {
        static $default_text = null;
        if (is_null($default_text)) {
            $default_text = Mage::getStoreConfig('twittertweet/general/text', Mage::app()->getStore()->getId());
        }
        return $default_text;
    }

    public function getRelated()
    {
        static $related = null;
        if (is_null($related)) {
            $related = Mage::getStoreConfig('twittertweet/general/related', Mage::app()->getStore()->getId());
        }
        return $related;
    }

    public function getCount()
    {
        static $count = null;
        if (is_null($count)) {
            $count = Mage::getStoreConfig('twittertweet/general/count', Mage::app()->getStore()->getId());
        }
        return $count;
    }

    public function getCounturl()
    {
        static $counturl = null;
        if (is_null($counturl)) {
            $counturl = Mage::getStoreConfig('twittertweet/general/counturl', Mage::app()->getStore()->getId());
        }
        return $counturl;
    }

    public function getWidth()
    {
        static $width = null;
        if (is_null($width)) {
            $width = Mage::getStoreConfig('twittertweet/general/width', Mage::app()->getStore()->getId());
        }
        return $width;
    }

    public function getHeight()
    {
        static $height = null;
        if (is_null($height)) {
            $height = Mage::getStoreConfig('twittertweet/general/height', Mage::app()->getStore()->getId());
        }
        return $height;
    }

    //content settings

    public function isShowInCms()
    {
        return Mage::getStoreConfig('twittertweet/content/show_in_cms', Mage::app()->getStore()->getId());
    }

    public function isShowInHome()
    {
        return Mage::getStoreConfig('twittertweet/content/show_in_home', Mage::app()->getStore()->getId());
    }

    public function isShowOnProductPage()
    {
        return Mage::getStoreConfig('twittertweet/content/show_in_product', Mage::app()->getStore()->getId());
    }

    public function isShowInCategoryPage()
    {
        return Mage::getStoreConfig('twittertweet/content/show_in_category', Mage::app()->getStore()->getId());
    }

    public function isShowCustom()
    {
        return Mage::getStoreConfig('twittertweet/content/show_custom', Mage::app()->getStore()->getId());
    }

    public function isShowWidget()
    {
        return Mage::getStoreConfig('twittertweet/content/show_widget', Mage::app()->getStore()->getId());
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
