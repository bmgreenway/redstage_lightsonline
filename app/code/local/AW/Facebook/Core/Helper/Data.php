<?php

class AW_Facebook_Core_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_defaultCode = 'en_US';
    const VAR_APP_ID = 'app_id';
    const VAR_LOCAL  = 'local';
    const VAR_ADMINS = 'admins';
    protected $_facebookLocaleCode = array(
        'af_ZA', 'az_AZ', 'id_ID', 'ms_MY', 'bs_BA', 'ca_ES', 'cs_CZ',
        'cy_GB', 'da_DK', 'de_DE', 'et_EE', 'en_PI', 'en_GB', 'en_UD',
        'en_US', 'es_LA', 'es_ES', 'eo_EO', 'eu_ES', 'tl_PH', 'fo_FO',
        'fr_CA', 'fr_FR', 'fy_NL', 'ga_IE', 'gl_ES', 'ko_KR', 'hr_HR',
        'is_IS', 'it_IT', 'ka_GE', 'sw_KE', 'ku_TR', 'lv_LV', 'fb_LT',
        'lt_LT', 'la_VA', 'hu_HU', 'nl_NL', 'ja_JP', 'nb_NO', 'nn_NO',
        'pl_PL', 'pt_BR', 'pt_PT', 'ro_RO', 'ru_RU', 'sq_AL', 'sk_SK',
        'sl_SI', 'fi_FI', 'sv_SE', 'th_TH', 'vi_VN', 'tr_TR', 'zh_CN',
        'zh_TW', 'zh_HK', 'el_GR', 'bg_BG', 'mk_MK', 'sr_RS', 'uk_UA',
        'hy_AM', 'he_IL', 'ar_AR', 'ps_AF', 'fa_IR', 'ne_NP', 'hi_IN',
        'bn_IN', 'pa_IN', 'ta_IN', 'te_IN', 'ml_IN',
    );

    public function getAppID()
    {
        static $app_id = null;
        if (is_null($app_id)) {
            $app_id = Mage::getStoreConfig('facebookcore/general/app_id', Mage::app()->getStore()->getId());
        }
        return $app_id;
    }

    public function getAppSecret()
    {
        static $app_secret = null;
        if (is_null($app_secret)) {
            $app_secret = Mage::getStoreConfig('facebookcore/general/app_secret', Mage::app()->getStore()->getId());
        }
        return $app_secret;
    }

    public function getAdmins()
    {
        return Mage::getStoreConfig('facebookcore/general/admins', Mage::app()->getStore()->getId());
    }

    /**
     * @return AW_Facebook_Core_Model_Facebook
     */
    public function getFacebook()
    {
        $facebook = Mage::registry('facebookcore_facebook_object');
        if (is_null($facebook)) {
            $facebook = Mage::getModel('facebookcore/facebook')
                ->setAppId($this->getAppID())
                ->setSecret($this->getAppSecret())
                ->setCookie(true)
                ->init();
            Mage::register('facebookcore_facebook_object', $facebook);
        }
        return $facebook;
    }

    public function isHttps()
    {
        return Mage::app()->getStore()->isCurrentlySecure();
    }

    public function getLocaleCode()
    {
        $localCode = Mage::app()->getLocale()->getLocaleCode();
        $localCode = in_array($localCode, $this->_facebookLocaleCode) ? $localCode : $this->_defaultCode;
        return $localCode;
    }


    public function checkApp()
    {
        $facebook = $this->getFacebook();
        try {
            $facebook->getFacebook()->api('/19292868552');
            return true;
        } catch (Exception $exc) {
            return false;
        }
    }

    public function checkMetaTag($meta)
    {
        return $this->getFacebook()->isMetaAdded($meta);
    }

    public function addMetaTag($meta)
    {
        $this->getFacebook()->addMeta($meta);
    }
}
