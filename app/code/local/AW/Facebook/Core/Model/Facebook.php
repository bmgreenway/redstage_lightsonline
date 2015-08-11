<?php

class AW_Facebook_Core_Model_Facebook extends Mage_Core_Model_Abstract
{

    const CONFIG_APPID         = 'appId';
    const CONFIG_SECRET        = 'secret';
    const CONFIG_COOKIE        = 'cookie';
    const CONFIG_PERMS         = 'scope';
    const PLUGINS_URL          = 'http://www.facebook.com/plugins/';
//    const CONNECT_BUTTON_TAG   = 'fb:login-button';
//    const LIKE_BUTTON_TAG      = 'fb:like';
//    const COMMENTS_BUTTON_TAG  = 'fb:comments';
//    const SUBSCRIBE_BUTTON_TAG = 'fb:subscribe';






    protected $_facebook = null;

    public function init($reset = false)
    {
        if (is_null($this->getFacebook()) || $reset) {
            require_once Mage::getConfig()->getOptions()->getLibDir() . '/facebook/facebook.php';
            $facebook = new Facebook($this->getConfigData());
            $facebook->setExtendedAccessToken();
            $this->setFacebook($facebook);
        }
        return $this;
    }

    public function getConfigData()
    {
        if ($config_data = (array)$this->getData('config_data')) {
            return $config_data;
        } else {
            return array(
                self::CONFIG_APPID  => $this->getAppId(),
                self::CONFIG_SECRET => $this->getSecret()
            );
        }
    }

    public function getFacebook()
    {
        return $this->_facebook;
    }

    public function setFacebook($facebook)
    {
        $this->_facebook = $facebook;
    }







    public function insertXmlnsParams($html)
    {
        if (!Mage::registry('aw_facebook_xmlns_inserted')) {
            $html = preg_replace('/(<html [^\>]*)/ism', '$1 xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#"', $html);
            Mage::register('aw_facebook_xmlns_inserted', true);
        }
        return $html;
    }



    public function getFacebookHtml()
    {
        $facebook = $this->getFacebook();
        if (!($facebook instanceof Facebook)) {
            return '';
        }
        $html = '';
        if (!Mage::registry('aw_facebook_html')) {
            $html = Mage::getSingleton('core/layout')->createBlock('facebookcore/init','facebookcore')->setFacebook($facebook)->toHtml();
            Mage::register('aw_facebook_html', true);
        }
        return $html;
    }

    public function isMetaAdded($meta)
    {
        $metas = (array)Mage::registry('aw_facebook_meta');

        return in_array($meta, $metas);
    }

    public function addMeta($meta)
    {
        $metas = (array)Mage::registry('aw_facebook_meta');

        array_push($metas, $meta);

        Mage::unregister('aw_facebook_meta');

        Mage::register('aw_facebook_meta', $metas);
    }


    public function getPluginsUrl()
    {
        return 'http' . (Mage::app()->getStore()->isCurrentlySecure() ? 's' : '') . '://www.facebook.com/plugins/';
    }

}